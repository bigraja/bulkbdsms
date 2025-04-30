# BDSMS Laravel Package

Send SMS via bulksmsbd.net in Laravel using Notification system or Facade.

## Installation

```bash
composer require bigraja/bulksmsbd
```

## Publish Config File

```bash
php artisan vendor:publish --provider="Bigraja\BulkSmsBD\BulkSmsBDServiceProvider" --tag="bulksmsbd-config"
```

## Configuration

Add to `.env`:

```
BULKSMSBD_API_KEY=your_api_key
BULKSMSBD_SENDER_ID=your_sender_id
```

## Usage

```php
use BulkSmsBD;

BulkSmsBD::send('88017XXXXXXXX', 'Your message');
```

## Notification Channel

```php
public function via($notifiable)
{
    return [\Bigraja\BulkSmsBD\BulkSmsBDChannel::class];
}

public function toBulkSmsBD($notifiable)
{
    return "Your SMS message";
}
```
