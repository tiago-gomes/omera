<?php
  
  namespace App\Providers;
  
  use App\Events\SalesForceCreateEvent;
  use App\Events\SalesForceDeleteEvent;
  use App\Events\SalesForceSyncEvent;
  use App\Events\SalesForceUpdateEvent;
  use App\Listeners\SalesForceCreateListener;
  use App\Listeners\SalesForceDeleteListener;
  use App\Listeners\SalesForceSyncListener;
  use App\Listeners\SalesForceUpdateListener;
  use Illuminate\Auth\Events\Registered;
  use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
  use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
  use Illuminate\Support\Facades\Event;
  
  class EventServiceProvider extends ServiceProvider
  {
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
      SalesForceCreateEvent::class => [
        SalesForceCreateListener::class,
      ],
      SalesForceUpdateEvent::class => [
        SalesForceUpdateListener::class
      ],
      SalesForceDeleteEvent::class => [
        SalesForceDeleteListener::class
      ],
      SalesForceSyncEvent::class => [
        SalesForceSyncListener::class
      ]
    ];
    
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
      //
    }
  }
