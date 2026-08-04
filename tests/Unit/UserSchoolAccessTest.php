<?php

use App\Models\User;

it('allows a school admin to manage users from the same school only', function () {
    $admin = new User([
        'role' => 'admin',
        'school_id' => 10,
        'can_manage_all_schools' => false,
    ]);

    $sameSchoolStudent = new User(['role' => 'student', 'school_id' => 10]);
    $otherSchoolStudent = new User(['role' => 'student', 'school_id' => 20]);

    expect($admin->canManageUser($sameSchoolStudent))->toBeTrue()
        ->and($admin->canManageUser($otherSchoolStudent))->toBeFalse();
});

it('allows only an admin with permission to manage users across schools', function () {
    $admin = new User([
        'role' => 'admin',
        'school_id' => 10,
        'can_manage_all_schools' => true,
    ]);
    $teacher = new User(['role' => 'teacher', 'school_id' => 20]);

    expect($admin->canManageAllSchools())->toBeTrue()
        ->and($admin->canManageUser($teacher))->toBeTrue();
});

it('does not grant cross-school management permission to non-admin users', function () {
    $teacher = new User([
        'role' => 'teacher',
        'school_id' => 10,
        'can_manage_all_schools' => true,
    ]);
    $student = new User(['role' => 'student', 'school_id' => 10]);

    expect($teacher->canManageAllSchools())->toBeFalse()
        ->and($teacher->canManageUser($student))->toBeFalse();
});

it('protects an all-school admin from school-scoped administrators', function () {
    $schoolAdmin = new User([
        'role' => 'admin',
        'school_id' => 10,
        'can_manage_all_schools' => false,
    ]);
    $allSchoolAdmin = new User([
        'role' => 'admin',
        'school_id' => 10,
        'can_manage_all_schools' => true,
    ]);

    expect($schoolAdmin->canManageUser($allSchoolAdmin))->toBeFalse();
});
