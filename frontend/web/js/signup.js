/**
 * Created by Dudarev on 16.01.2017.
 */

function whenLeader(attribute, value) {
    return $('#signup_type').val() == '1';
}

function whenStudent(attribute, value) {
    return $('#signup_type').val() == '0';
}

function whenStudentSpeciality(attribute, value) {
    return whenStudent(attribute, value) && $('#signup_student_speciality').val().length == 0;
}

$(function () {
    var $signup_type = $('#signup_type'),
        $student_speciality = $('#signup_student_speciality');

    $signup_type
        .on('change', function () {
            var $this = $(this),
                value = $this.val();

            $('.signup-categorization-fields').hide();
            $('.signup-categorization-fields[data-type="' + value + '"]').show();
        })
        .trigger('change');

    $student_speciality
        .on('change', function () {
            var $this = $(this),
                value = $this.val();

            if (value.length == 0) {
                $('.signup-student-speciality-fields').show();
            } else {
                $('.signup-student-speciality-fields').hide();
            }
        })
        .trigger('change');
});