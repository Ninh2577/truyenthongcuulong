<div>
    <div>
        @if($this->isConfirmingSetup)
            <x-filament-two-factor-authentication::setup-confirmation />
        @elseif($this->enableTwoFactorAuthentication->isVisible())
            <x-filament-two-factor-authentication::enable />
        @elseif($this->disableTwoFactorAuthentication->isVisible())
            <x-filament-two-factor-authentication::enabled />

            @if($this->showRecoveryCodes)
                <x-filament-two-factor-authentication::recovery-codes />
            @endif

            <div class="mt-6 flex flex-wrap items-center justify-center gap-3 pt-4 border-t border-slate-100 dark:border-gray-800">
                {{ $this->generateNewRecoveryCodes }}
                {{ $this->disableTwoFactorAuthentication }}
            </div>
        @endif
    </div>

    <x-filament-actions::modals />
</div>
