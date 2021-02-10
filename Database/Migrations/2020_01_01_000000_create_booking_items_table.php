<?php

use Illuminate\Database\Schema\Blueprint;
//----- bases ----
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateBookingItemsTable
 */
class CreateBookingItemsTable extends XotBaseMigration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //-- CREATE --
        if (! $this->tableExists()) {
            $this->getConn()->create(
                $this->getTable(),
                function (Blueprint $table) {
                    $table->increments('id');
                    $table->nullableMorphs('shop');
                    $table->string('name', 32)->nullable();
                    $table->integer('min_capacity')->nullable();
                    $table->integer('max_capacity')->nullable();
                    $table->integer('status')->nullable();
                    $table->string('created_by')->nullable();
                    $table->string('updated_by')->nullable();
                    $table->timestamps();

                }
            );
        }
        //-- UPDATE --
        $this->getConn()->table($this->getTable(),
            function (Blueprint $table) {
            //if (! $this->hasColumn('price_complete')) {
            //    $table->decimal('price_complete', 10, 3)->nullable();
            //}
            }
        );

    }//end function up
}//end class
