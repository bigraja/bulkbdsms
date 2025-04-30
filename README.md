# BDSMS Laravel Package

Send SMS via bulksmsbd.net in Laravel using Notification system or Facade.

## Installation

```bash
composer require bigraja/bulkbdsms
```

## Configuration

Add to `.env`:

```
BDSMS_API_KEY=your_api_key
BDSMS_SENDER_ID=your_sender_id
```

## Usage

```php
use BulkBDSms;

BulkBDSms::send('88017XXXXXXXX', 'Your message');
```

## Notification Channel

```php
public function via($notifiable)
{
    return [\Bigraja\BulkBDSms\BulkBDSmsChannel::class];
}

public function toBulkBDSms($notifiable)
{
    return "Your SMS message";
}
```
