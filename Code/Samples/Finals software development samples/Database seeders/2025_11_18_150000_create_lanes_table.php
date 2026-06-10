<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('lanes', function (Blueprint $table) 
		{
			$table->id();
			$table->unsignedSmallInteger('number')->unique();
			$table->string('label')->nullable();
			$table->boolean('is_active')->default(true);
			$table->unsignedSmallInteger('sort_order')->default(0);
			$table->timestamps();
		});

		$now = now();

		foreach (range(1, 8) as $index => $number) 
		{
			DB::table('lanes')->insert([
				'number' => $number,
				'label' => null,
				'is_active' => true,
				'sort_order' => $index + 1,
				'created_at' => $now,
				'updated_at' => $now,
			]);
		}
	}

	public function down(): void
	{
		Schema::dropIfExists('lanes');
	}
};
