<?php
// not fully done
final class Alerts
{
    private Alerts $instance;

    private static function getInstance(): self
    {
        //lazy initialization
        if (! isset(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private array $alerts = [];

    // constructor doesn't have to do anything but for singleton it is private so it cannot be accessed outside this class
    private function __construct()
    {}
    // empty clone method that is private so this class cannot be cloned due to being a singleton
    private function __clone()
    {}

    public function addAlert(string $type, string $message): self
    {
        $this->alerts[$type] = $message;

        return $this;
    }

    public function getAlert(string $type): array
    {
        return $this->array[$type] ?? [];
    }

    public function getAll(): array
    {
        return $this->alerts;
    }

    // Alerts::getInstance()->add('success', 'Hooray');
    // $allAlerts = Alerts::getInstance()->all();
    // $successAlerts = Alerts::getInstance()->get('success');
    // $alerts->add('success', 'Account successfully updated')
    //     ->add('warning', 'Please re-verify your new email');
}

class Login
{
    public function register(array $input)
    {
        if ($this->users->register($input)) {
            Alerts::addAlert('success', 'Please check your inbox');
            (new Alerts)->addAlerts('success', 'Please check your inbox');
            return view('registration.success', compact('alerts'));
        }
    }
}