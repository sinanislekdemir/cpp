<?php

abstract class BookingObserver 
{
    abstract public function update($booking);
}

class MailObserver extends BookingObserver
{
    public function update($booking)
    {
        echo "sending mail for {$booking->processid} \n";
    }
}

class SMSObserver extends BookingObserver
{
    public function update($booking)
    {
        echo "sending sms for {$booking->processid} \n";
    }
}

class Booking{
    public $processid;
    protected $observers = array();

    public function __construct($processid)
    {
        $this->processid = $processid;
    }

    public function attach(BookingObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function update()
    {
        echo "Saving to database \n";
        foreach($this->observers as $observer)
        {
            $observer->update($this);
        }
    }

}

$booking = new Booking('HP-1231231');
$booking->attach(new MailObserver());
$booking->attach(new SMSObserver());

$booking->update();
