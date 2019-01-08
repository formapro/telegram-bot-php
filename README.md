# PHP Telegram Bot

Telegram bot as it should be.

## Examples

### SetWebhook

```php
<?php
use Formapro\TelegramBot\Bot;
use Formapro\TelegramBot\SetWebhook;
use function GuzzleHttp\Psr7\str;

$bot = new Bot('telegramToken');

$setWebhook = new SetWebhook('https://your.app/telegram-updates-hook');

// uncomment if use use self-signed certificate
// $setWebhook->setCertificate(file_get_contents('/path/to/self-signed-certifcate.pem'));

$response = $this->bot->setWebhook($setWebhook);

echo str($response);
```

### GetWebhookInfo

```php
<?php
use Formapro\TelegramBot\Bot;
use function GuzzleHttp\Psr7\str;

$bot = new Bot('telegramToken');

$response = $this->bot->getWebhookInfo();

echo str($response);
```

### SendMessage

Just text: 

```php
<?php
use Formapro\TelegramBot\Bot;
use function GuzzleHttp\Psr7\str;

$bot = new Bot('telegramToken');

$response = $this->bot->getWebhookInfo();

echo str($response);
```

### SendMessage

```php
<?php
use Formapro\TelegramBot\Bot;
use Formapro\TelegramBot\Update;
use Formapro\TelegramBot\SendMessage;

$requestBody = file_get_contents('php://input'); 
$data = json_decode($requestBody, true);

$update = Update::create($data);

$bot = new Bot('telegramToken');
$bot->sendMessage(new SendMessage(
    $update->getMessage()->getChat()->getId(),
    'Hi there! What can I do?'
));
```

### ReplyKeyboardMarkup

```php
<?php
use Formapro\TelegramBot\Bot;
use Formapro\TelegramBot\Update;
use Formapro\TelegramBot\SendMessage;
use Formapro\TelegramBot\KeyboardButton;
use Formapro\TelegramBot\ReplyKeyboardMarkup;

$requestBody = file_get_contents('php://input'); 
$data = json_decode($requestBody, true);

$update = Update::create($data);

$fooButton = new KeyboardButton('foo');
$barButton = new KeyboardButton('bar');
$bazButton = new KeyboardButton('bar');
$keyboard = new ReplyKeyboardMarkup([[$fooButton], [$barButton, $bazButton]]);

$sendMessage = new SendMessage($update->getMessage()->getChat()->getId(), 'Choose an option.');
$sendMessage->setReplyMarkup($keyboard);

$bot = new Bot('telegramToken');
$bot->sendMessage($sendMessage);
```

Request Contacts:

```php
<?php
use Formapro\TelegramBot\Bot;
use Formapro\TelegramBot\Update;
use Formapro\TelegramBot\SendMessage;
use Formapro\TelegramBot\KeyboardButton;
use Formapro\TelegramBot\ReplyKeyboardMarkup;

$requestBody = file_get_contents('php://input'); 
$data = json_decode($requestBody, true);

$update = Update::create($data);

$button = new KeyboardButton('Share my contacts');
$button->setRequestContact(true);
$keyboard = new ReplyKeyboardMarkup([[$button]]);
$keyboard->setOneTimeKeyboard(true);

$sendMessage = new SendMessage($update->getMessage()->getChat()->getId(), 'Please, share your contact info with us.');
$sendMessage->setReplyMarkup($keyboard);

$bot = new Bot('telegramToken');
$bot->sendMessage($sendMessage);
```

### InlineKeyboardButton

```php
<?php
use Formapro\TelegramBot\InlineKeyboardButton;
use Formapro\TelegramBot\InlineKeyboardMarkup;
use Formapro\TelegramBot\SendMessage;
use Formapro\TelegramBot\Bot;
use Formapro\TelegramBot\Update;

$requestBody = file_get_contents('php://input'); 
$data = json_decode($requestBody, true);

$update = Update::create($data);

$button = new InlineKeyboardButton('inline button');
$keyboard = new InlineKeyboardMarkup([[$button]]);
        
$sendMessage = new SendMessage($update->getMessage()->getChat()->getId(), 'Click on inline button.');
$sendMessage->setReplyMarkup($keyboard);
                
$bot = new Bot('telegramToken');
$bot->sendMessage($sendMessage);
```

Inline link button: 

```php
<?php
use Formapro\TelegramBot\InlineKeyboardButton;
use Formapro\TelegramBot\InlineKeyboardMarkup;
use Formapro\TelegramBot\SendMessage;
use Formapro\TelegramBot\Bot;
use Formapro\TelegramBot\Update;

$requestBody = file_get_contents('php://input'); 
$data = json_decode($requestBody, true);

$update = Update::create($data);

$linkButton = new InlineKeyboardButton('Go to site');
$linkButton->setUrl('https://your.app/link');
$keyboard = new InlineKeyboardMarkup([[$linkButton]]);
        
$sendMessage = new SendMessage($update->getMessage()->getChat()->getId(), 'Go to site');
$sendMessage->setReplyMarkup($keyboard);
                
$bot = new Bot('telegramToken');
$bot->sendMessage($sendMessage);
```

## Developed by Forma-Pro

Forma-Pro is a full stack development company which interests also spread to open source development. 
Being a team of strong professionals we have an aim an ability to help community by developing cutting edge solutions in the areas of e-commerce, docker & microservice oriented architecture where we have accumulated a huge many-years experience. 
Our main specialization is Symfony framework based solution, but we are always looking to the technologies that allow us to do our job the best way. We are committed to creating solutions that revolutionize the way how things are developed in aspects of architecture & scalability.

If you have any questions and inquires about our open source development, this product particularly or any other matter feel free to contact at opensource@forma-pro.com

## License

It is released under the [MIT License](LICENSE).
