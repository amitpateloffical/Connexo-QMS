<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_management', function (Blueprint $table) {
            $table->id();
            $table->string('form_type')->nullable();
            $table->integer('initiator_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('division_code')->nullable();
            $table->string('intiation_date')->nullable();
            $table->string('Initiator_Group')->nullable();
            $table->string('due_date')->nullable();
            $table->integer('record')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();
            $table->string('short_description')->nullable();
            $table->string('open_date')->nullable();
            $table->string('assign_id')->nullable();
            $table->string('departments')->nullable();
            $table->string('team_members')->nullable();
            $table->string('source_of_risk')->nullable();
            $table->string('type')->nullable();
            $table->string('priority_level')->nullable();
            $table->string('zone')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('description')->nullable();
            $table->string('comments')->nullable();
            $table->string('severity2_level')->nullable();
            $table->text('departments2')->nullable();
            $table->text('source_of_risk2')->nullable();
            $table->text('site_name')->nullable();
            $table->text('building')->nullable();
            $table->text('floor')->nullable();
            $table->text('room')->nullable();
            $table->text('related_record')->nullable();
            $table->text('duration')->nullable();
            $table->string('hazard')->nullable();
            $table->string('room2')->nullable();
            $table->string('regulatory_climate')->nullable();
            $table->string('Number_of_employees')->nullable();
            $table->string('risk_management_strategy')->nullable();
            $table->string('schedule_start_date1')->nullable();
            $table->string('schedule_end_date1')->nullable();
            $table->string('estimated_man_hours')->nullable();
            $table->string('estimated_cost')->nullable();
            $table->string('currency')->nullable();
            $table->string('team_members2')->nullable();
            $table->string('training_require')->nullable();
            $table->string('justification')->nullable();
            $table->text('reference')->nullable();
            $table->text('root_cause_methodology')->nullable();
            $table->text('measurement')->nullable();
            $table->string('materials')->nullable();
            $table->string('methods')->nullable();
            $table->string('environment')->nullable();
            //$table->string('manpower')->nullable();
            //$table->string('machine')->nullable();
            //$table->string('problem_statement')->nullable();
            $table->text('cost_of_risk')->nullable();
            $table->text('environmental_impact')->nullable();
            $table->text('public_perception_impact')->nullable();
            $table->text('calculated_risk')->nullable();
            $table->text('impacted_objects')->nullable();
            $table->text('severity_rate')->nullable();
            $table->string('occurrence')->nullable();
            $table->string('detection')->nullable();
            $table->string('detection2')->nullable();
            $table->string('rpn')->nullable();
            $table->string('residual_risk')->nullable();
            $table->string('residual_risk_impact')->nullable();
            $table->string('residual_risk_probability')->nullable();
            $table->string('analysisN2')->nullable();
            $table->string('analysisRPN2')->nullable();
            $table->string('rpn2')->nullable();
            $table->string('comments2')->nullable();
            $table->text('investigation_summary')->nullable();
            $table->text('root_cause_description')->nullable();
            $table->string('refrence_record')->nullable();
            $table->string('mitigation_required')->nullable();
            $table->text('mitigation_plan')->nullable();
            $table->text('mitigation_due_date')->nullable();
            $table->text('mitigation_status')->nullable();
            $table->text('mitigation_status_comments')->nullable();
            $table->string('impact')->nullable();
            $table->string('criticality')->nullable();
            $table->string('impact_analysis')->nullable();
            $table->text('risk_analysis')->nullable();
            $table->text('severity')->nullable();
            $table->text('occurance')->nullable();
            $table->string('status')->nullable();
            $table->integer('stage')->nullable();
            $table->string('submitted_by')->nullable();
            $table->string('evaluated_by')->nullable();
            $table->string('plan_approved_by')->nullable();
            $table->string('risk_analysis_completed_by')->nullable();
            $table->string('submitted_on')->nullable();
            $table->string('evaluated_on')->nullable();
            $table->string('plan_approved_on')->nullable();
            $table->string('risk_analysis_completed_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risk_management');
    }
};
