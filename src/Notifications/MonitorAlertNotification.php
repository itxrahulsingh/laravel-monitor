<?php

namespace Itxrahulsingh\LaravelMonitor\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class MonitorAlertNotification extends Notification
{
    use Queueable;

    protected $alert;

    public function __construct($alert)
    {
        $this->alert = $alert;
    }

    public function via($notifiable)
    {
        return array_filter(array_keys(config('laravel-monitor.notifications.channels', [])));
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Laravel Monitor Alert')
            ->line("Alert: {$this->alert->alert_type}")
            ->line($this->alert->message)
            ->action('View Dashboard', url(config('laravel-monitor.dashboard.route')));
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->error()
            ->content("Alert: {$this->alert->alert_type}\n{$this->alert->message}");
    }
}
