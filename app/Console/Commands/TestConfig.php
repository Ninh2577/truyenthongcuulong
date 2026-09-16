<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Filament\Forms\Components\Field::configureUsing(function (\Filament\Forms\Components\Field $field) {
            $field->extraInputAttributes(function () use ($field) {
                if ($field->isRequired()) {
                    $label = strtolower($field->getLabel() ?? 'thông tin này');
                    $prefix = in_array(get_class($field), [\Filament\Forms\Components\Select::class, \Filament\Forms\Components\Radio::class]) ? 'chọn' : 'nhập';
                    return [
                        'oninvalid' => "this.setCustomValidity('Vui lòng {$prefix} {$label}')",
                        'oninput' => "this.setCustomValidity('')",
                    ];
                }
                return [];
            });
        });

        $input = \Filament\Forms\Components\TextInput::make('name')->label('Tên khách hàng')->required();
        echo json_encode($input->getExtraInputAttributes());
    }
}
