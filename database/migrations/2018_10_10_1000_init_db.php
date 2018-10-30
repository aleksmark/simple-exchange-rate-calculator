<?php

use Illuminate\Database\Migrations\Migration;

class InitDb extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $statement = <<<'SQL'
            CREATE TABLE currencies (
                name CHAR(3) NOT NULL,
                PRIMARY KEY (name)
            );

            CREATE TABLE exchanges (
                from_currency CHAR(3) NOT NULL,
                to_currency CHAR(3) NOT NULL,
                rate DECIMAL NOT NULl,
                FOREIGN KEY (from_currency) REFERENCES currencies(name),
                FOREIGN KEY (to_currency) REFERENCES currencies(name),
                UNIQUE unique_index(from_currency, to_currency)
            );
SQL;

        DB::unprepared($statement);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $statement = <<<'SQL'
            DROP table currencies, exchanges;
SQL;

        DB::unprepared($statement);
    }
}
