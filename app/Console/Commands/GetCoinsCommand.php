<?php

namespace App\Console\Commands;

use App\Models\Coin;
use Illuminate\Console\Command;

class GetCoinsCommand extends Command
{
    /**
     * Имя и сигнатура консольной команды.
     *
     * @var string
     */
    protected $signature = 'coins:get';

    /**
     * Описание консольной команды.
     *
     * @var string
     */
    protected $description = 'Получить данные о монетах из API';

    /**
     * Создание нового экземпляра консольной команды.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Выполнение консольной команды.
     *
     * @return void
     */
    public function handle() : void
    {
        $coinModel = new Coin();
        $coinModel->getCoins();
        $this->info('Монеты были получены.');
    }
}

