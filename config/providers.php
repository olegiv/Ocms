<?php declare(strict_types=1);

use Ocms\Core\Providers\ConfigProvider;
use Ocms\Core\Providers\RouterProvider;
use Ocms\Core\Providers\CoreProvider;
use Ocms\Core\Providers\DatabaseProvider;
use Ocms\Core\Providers\DispatcherProvider;
use Ocms\Core\Providers\SessionBagProvider;
use Ocms\Core\Providers\SessionProvider;
use Ocms\Core\Providers\UrlProvider;
use Ocms\Core\Providers\ViewProvider;
use Ocms\Core\Providers\VoltProvider;

return [
	CoreProvider::class,
	ConfigProvider::class,
    DatabaseProvider::class,
    DispatcherProvider::class,
    SessionProvider::class,
    SessionBagProvider::class,
	UrlProvider::class,
	RouterProvider::class,
	ViewProvider::class,
    VoltProvider::class
];
