<?php

use App\Modules\Subscriptions\Enums\Status;
use App\Modules\Subscriptions\Models\Plan;
use App\Modules\Users\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained((new User)->getTable())
                ->cascadeOnDelete();
            $table->foreignIdFor(Plan::class)
                ->constrained((new Plan)->getTable())
                ->cascadeOnDelete();
            $table->enum('status', Status::toArray())->default(Status::PENDING->value);
            $table->float('amount');
            $table->integer('users_count')->default(1);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
