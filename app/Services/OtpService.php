<?php

namespace App\Services;

use App\Mail\EmailVerificationOtp;
use Exception;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    public function generateOtp(User $user, string $type)
    {
        //MAKE OLD OTP EXPIRED
        $this->expiredOldOtp($user, $type);

        //GENRATE OTP
        $otp = $this->generateSecureCode();

        // SET EXPIRED DATE
        $expired_at = now()->addMinutes(10);

        // SET OTP IN DATABASE
        Otp::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'otp_type' => $type,
            'otp_code' => $otp,
            'expires_at' => $expired_at,
            'status' => 'pending'
        ]);

        log::info('OTP Generated Successfully', [
            'user_id' => $user->id,
            'otp_type' => $type,
        ]);
        return $otp;
    }

    public function sendOtpEmail(User $user, string $otpCode, string $type): bool
    {
        try {
            if ($type === 'email_verification') {
                Mail::to($user->email)->send(new EmailVerificationOtp($otpCode, $user));
            } elseif ($type === 'password_reset') {
                // Mail::to($user->email)->send(new PasswordResetOtp($otpCode, $user));
            }

            Log::info('OTP Email Sent Successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'otp_type' => $type,
            ]);

            return true;
        } catch (Exception $e) {
            Log::error('OTP Email Failed', [
                'user_id' => $user->id,
                'email' => $user->email,
                'otp_type' => $type,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    private function expiredOldOtp(User $user, string $type)
    {
        Otp::where('user_id', $user->id)
            ->where('otp_type', $type)
            ->where('status', 'pending')
            ->update(['status' => 'expired']);
    }




    //GENERATE SECURE CODE
    private function generateSecureCode()
    {
        return str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
    }

    public function generateAndSendOtpEmail(User $user, string $type)
    {
        try {
            // GENERATE OTP
            $otp = $this->generateOtp($user, $type);
            // SEND EMAIL
            $emailSent = $this->sendOtpEmail($user, $otp, $type);

            if (!$emailSent) {
                return ['success' => false, 'message' => 'Failed to send OTP email'];
            }

            return ['success' => true, 'message' => 'OTP sent successfully'];
        } catch (Exception $e) {
            Log::error('Failed to generate and send OTP', [
                'user_id' => $user->id,
                'otp_type' => $type,
                'error' => $e->getMessage()
            ]);

            return ['success' => false, 'message' => 'Failed to generate OTP'];
        }
    }

    public function verifyOtp(string $email, string $otp_code, $otp_type)
    {
        $otp = Otp::where('email', $email)
            ->where('otp_type', $otp_type)
            ->where('otp_code', $otp_code)
            ->where('status', 'pending')
            ->where('expires_at', '>=', now())
            ->first();

        if (!$otp) {
            log::warning('OTP Verification Failed - Invalid OTP', [
                'email' => $email,
                'otp_type' => $otp_type,
            ]);
            return ['success' => false, 'message' => 'Invalid or expired OTP code'];
        }

        //UPDATE OTP STATUS
        $otp->update([
            'status' => 'verified',
        ]);

        Log::info('OTP Verified Successfully', [
            'user_id' => $otp->user_id,
            'email' => $email,
            'otp_type' => $otp_type,
            'status' => $otp->status
        ]);

        return ['success' => true, 'user' => $otp->user, 'message' => 'OTP verified successfully'];
    }
}
