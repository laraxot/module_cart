<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
//----- bases ----
use Modules\Blog\Models\Location;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateCartsTable.
 */
class CreateCartsTable extends XotBaseMigration {
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
                    $table->string('shop_title')->nullable();
                    $table->integer('auth_user_id')->nullable();
                    $table->text('note');
                    $table->integer('status')->nullable();
                    $table->decimal('price_complete', 10, 3)->nullable();
                    //$table->string('related_type', 50)->index()->nullable();//non serve in teoria
                    $table->string('created_by')->nullable();
                    $table->string('updated_by')->nullable();
                    $table->string('deleted_by')->nullable();
                    $table->timestamps();
                }
            );
        }
        //-- UPDATE --
        $this->getConn()->table($this->getTable(), function (Blueprint $table) {
            if (! $this->hasColumn('price_complete')) {
                $table->decimal('price_complete', 10, 3)->nullable();
            }

            $address_components = Location::$address_components;
            foreach ($address_components as $el) {
                if (! $this->hasColumn($el)) {
                    $table->string($el)->nullable();
                }
                if (! $this->hasColumn($el.'_short')) {
                    $table->string($el.'_short')->nullable();
                }
            }
            if (! $this->hasColumn('address')) {
                $table->text('address')->nullable();
            }
            if (! $this->hasColumn('latitude')) {
                $table->decimal('latitude', 16, 13)->nullable();
            }
            if (! $this->hasColumn('longitude')) {
                $table->decimal('longitude', 16, 13)->nullable();
            }
            if (! $this->hasColumn('bell_boy_id')) {
                $table->integer('bell_boy_id')->nullable();
            }
            if (! $this->hasColumn('bell_boy_note')) {
                $table->text('bell_boy_note')->nullable();
            }
            if (! $this->hasColumn('bell_boy_full_name')) {
                $table->string('bell_boy_full_name')->nullable();
            }
            if (! $this->hasColumn('delivery_method')) {
                $table->integer('delivery_method')->nullable();
            }
            if (! $this->hasColumn('payment_method')) {
                $table->integer('payment_method')->nullable();
            }

            if (! $this->hasColumn('shop_id')) {
                $table->nullableMorphs('shop');
                $table->string('shop_title');
            }

            if (! $this->hasColumn('customer_fullname')) {
                $table->string('customer_fullname');
            }
        });
    }
}
