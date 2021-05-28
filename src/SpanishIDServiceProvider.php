<?php

namespace Interficie\SpanishID;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class SpanishIDServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SpanishID::class, function () {
            return new SpanishID();
        });
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'spanishid');

        $this->publishes([
            __DIR__ . '/../resources/lang' => $this->app->resourcePath('lang/vendor/spanishid'),
        ]);

        $this->addRules();
        $this->addMessages();
    }

    /**
     * Add rules
     *
     * @return void
     */
    private function addRules(): void
    {
        Validator::extend('dni', function ($attribute, $value, $parameters, $validator) {
            $identity = new SpanishID();
            return $identity->isValidNif(strtoupper($value));
        });

        Validator::extend('nif', function ($attribute, $value, $parameters, $validator) {
            $identity = new SpanishID();
            return $identity->isValidNif(strtoupper($value));
        });

        Validator::extend('cif', function ($attribute, $value, $parameters, $validator) {
            $identity = new SpanishID();
            return $identity->isValidCif(strtoupper($value));
        });

        Validator::extend('nie', function ($attribute, $value, $parameters, $validator) {
            $identity = new SpanishID();
            return $identity->isValidNie(strtoupper($value));
        });

        Validator::extend('nnss', function ($attribute, $value, $parameters, $validator) {
            $identity = new SpanishID();
            return $identity->isValidNNSS(strtoupper($value));
        });
    }

    /**
     * Add messages
     *
     * @return void
     * @throws BindingResolutionException
     */
    private function addMessages(): void
    {
        /** @var Translator $translator */
        $translator = $this->app->make(Translator::class);

        Validator::replacer('dni', function ($message, $attribute, $rule, $parameters) use ($translator) {
            return $translator->get('spanishid.validation.dni', ['attribute' => $attribute]);
        });

        Validator::replacer('nif', function ($message, $attribute, $rule, $parameters) use ($translator) {
            return $translator->get('spanishid.validation.nif', ['attribute' => $attribute]);
        });

        Validator::replacer('cif', function ($message, $attribute, $rule, $parameters) use ($translator) {
            return $translator->get('spanishid.validation.cif', ['attribute' => $attribute]);
        });

        Validator::replacer('nie', function ($message, $attribute, $rule, $parameters) use ($translator) {
            return $translator->get('spanishid.validation.nie', ['attribute' => $attribute]);
        });

        Validator::replacer('nnss', function ($message, $attribute, $rule, $parameters) use ($translator) {
            return $translator->get('spanishid.validation.nnss', ['attribute' => $attribute]);
        });
    }
}
