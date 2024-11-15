<?php

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
        Schema::create('new_users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 255);
            $table->string('dob_bs', 20);
            $table->string('dob_ad', 20);
            $table->string('citizenship_no', 50);
            $table->string('citizenship_issued', 50);
            $table->string('citizenship_district', 100);
            $table->string('permanent_district', 100);
            $table->string('permanent_municipality', 100);
            $table->string('permanent_ward_no', 100);
            $table->string('permanent_tole', 255);
            $table->string('federal_province', 100)->nullable();
            $table->string('federal_district', 100)->nullable();
            $table->string('federal_municipality', 100)->nullable();
            $table->string('federal_ward_no', 100)->nullable();
            $table->string('federal_tole', 100)->nullable();
            $table->string('federal_house_no', 100)->nullable();
            $table->string('temporary_province', 100)->nullable();
            $table->string('temporary_district', 100)->nullable();
            $table->string('temporary_municipality', 100)->nullable();
            $table->string('temporary_ward_no', 100)->nullable();
            $table->string('temporary_tole', 100)->nullable();
            $table->string('temporary_house_no', 100)->nullable();
            $table->string('email', 255);
            $table->string('mobile', 15);
            $table->string('father_name', 255)->nullable();
            $table->string('grandfather_name', 255)->nullable();
            $table->string('spouse_name', 255)->nullable();
            $table->enum('relation_type', ['grandfather', 'father_in_law']);
            $table->enum('spouse_relation', ['husband', 'wife'])->nullable();
            $table->enum('payment_method', ['cash', 'cheque', 'bankDeposit', 'ips']);
            $table->string('pan', 15)->nullable();
            $table->string('education_level', 255)->nullable();
            $table->string('degree', 255)->nullable();
            $table->string('profession', 255)->nullable();
            $table->string('organization', 255)->nullable();
            $table->string('organization_address', 255)->nullable();
            $table->decimal('share', 15, 2)->nullable();
            $table->decimal('investment_amount', 15, 2)->nullable();
            $table->string('amount_in_words', 255)->nullable();
            $table->string('photo')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('signature')->nullable();
            $table->string('voucher')->nullable();
            $table->boolean('is_minor')->default(0);
            $table->string('minor_father_name')->nullable();
            $table->string('parent_district')->nullable();
            $table->string('parent_municipality')->nullable();
            $table->string('parent_ward_no')->nullable();
            $table->string('parent_tole')->nullable();
            $table->string('parent_citizenship')->nullable();
            $table->string('minor_guardian_relation')->nullable();
            $table->string('minor_guardian_bank_name')->nullable();
            $table->string('minor_guardian_bank_account_number')->nullable();
            $table->string('national_id_no')->nullable();
            $table->string('national_id')->nullable();
            $table->string('registration_number', 100);
            $table->enum('status', ['pending', 'approved', 'disapproved'])->default('pending');
            $table->boolean('accept_terms')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_users');
    }
};
