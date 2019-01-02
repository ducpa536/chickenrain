$(document).ready(function() {
    $('.search-book').keyup(function() {
        let valueSearch = $(this).val();
        let url = `/chicken/books/search/keyword:${valueSearch}`;
        window.history.pushState('',"", url); //search mà nó hiển thị theo url
        $.ajax({
            url: url,
            method: 'POST',
            data: {valueSearch: valueSearch},
            dataType: 'json',
            success: function(data) { //nhan du lieu tu controller
                // console.log(data);
                if (data && data.books && data.books.length > 0) {
                    let html = '';
                    data.books.map((item, index) => {
                        html += item.Book.title + '<br>';
                        // console.log(item.Book.title);
                        // console.log(item.Writer);
                    });
                    $('.list-result').html(html);
                }
                if (data && data.books && data.books.length === 0) {
                    $('.list-result').text('');
                }
                if (data && data.message) {
                    $('.list-result').text(data.message);
                }
            }
        });
    });
});