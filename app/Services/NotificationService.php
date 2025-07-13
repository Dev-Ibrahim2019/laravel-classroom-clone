<?php

namespace App\Services;

class NotificationService
{
    /**
     * Send notification
     */
    public function send($message)
    {
        return "Notification sent: $message";
    }
}

