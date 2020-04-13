$(document).ready(function () {
        $('.delete-btn').on('click', function () {
            $(this).parents('tr').first().detach();
        })
    document.querySelector('#btn').addEventListener('click', function () {
        document.querySelector('#liste td').style.fontWeight='700';
        console.log('.delete-btn');
    });
})