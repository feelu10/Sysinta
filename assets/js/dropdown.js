$(document).ready(function() {
    $('#semester').change(function() {
        var semester = $(this).val();
        
        var courses;
        
        // Define the course options for each semester
        if (semester === '120') {
            courses = [
                '<option value="GEUSELF">Understanding Self</option>',
                '<option value="INTCOMP">Introduction to Computing (2/1)</option>',
                '<option value="CMPROG1">Computer Programming 1 (2/1)</option>',
                '<option value="GEPE001">Physical Education-1</option>',
                '<option value="GENSTP1">NSTP-1</option>',
                '<option value="PCCALGE">Linear Algebra</option>',
                '<option value="PCCCHI1">Mandarin-1</option>',
                '<option value="PCCGMC1">Language Development</option>'
            ];
        } else if (semester === '220') {
            // Define your 2nd semester courses here
            courses = [
                '<option value="GEPHIST">Readings in Phil. History</option>',
                '<option value="DISCMAT">Discrete Mathematics</option>',
                '<option value="CMPROG2">Computer Programming 2 (2/1)</option>',
                '<option value="GEARTAP">Art Appreciation</option>',
                '<option value="PCCTRIG">Trigonometry and Solid Mensuration</option>',
                '<option value="GEPE002">Physical Education-2</option>',
                '<option value="PCCGMC2">English for Global Opportunity</option>',
                '<option value="PCCCHI2">Mandarin-2</option>',
                '<option value="GEETHIC">Ethics</option>'
            ];
        } else if (semester === '320') {
            // Define your 3rd semester courses here
            courses = [
                '<option value="GEWORLD">The Contemporary World</option>',
                '<option value="INTRHCL">Introduction to Human Computer Interaction</option>',
                '<option value="DSALGOR">Data Structures and Algorithms</option>',
                '<option value="OORPROG">Object-Oriented Programming</option>',
                '<option value="GEPCOMM">Purposive Communication</option>',
                '<option value="GEMATMW">Mathematics in the Modern World</option>',
                '<option value="GEPE003">Physical Education 3</option>',
                '<option value="PCCCHI3">Mandarin 3</option>'
            ];
        } else {
            courses = ['<option value="">Please select a semester</option>'];
        }
        
        $('#courseID').html(courses.join(''));
    });
});