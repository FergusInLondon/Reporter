<?php

use App\Entities\Document\Factory as DocumentFactory;
use App\Entities\Document\Document;
use App\Entities\Payment\Factory as PaymentFactory;
use App\Entities\Payment\Payment;
use App\Entities\Client\Factory as ClientFactory;
use App\Entities\Client\Client;
use App\Entities\File\Factory as FileFactory;
use App\Entities\File\File;
use App\Entities\User\Factory as UserFactory;
use App\Entities\User\User;


$factory->define(Document::class, new DocumentFactory());
$factory->define(Payment::class,  new PaymentFactory());
$factory->define(Client::class,   new ClientFactory());
$factory->define(File::class,     new FileFactory());
$factory->define(User::class,     new UserFactory());