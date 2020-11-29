function typeaheadCountries() {
    $('#search_countries').typeahead({
                highlight: true,
                hint: true,
                minLength: 3
            },
            {
                limit: 50,
                name: 'area',
                display: 'value',
                source: function(query, syncResults, asyncResults) {
                    $.get('../countries'+'?search=' + query, function(response) {
                        if(response){
                            var data = $.map(response, data => ({
                            country: data.country,
                            image: data.image
                        }));
                        asyncResults(data);
                        }
                    });
                },
                templates: {
                    empty: [
                        '<div class="text-danger">',
                        ' No data found',
                        '</div>'
                    ].join('\n'),
                    suggestion: function(data) {
                        return  '<div><img style="height:20px;width:20px;" src="'+data.image+'" alt="">&nbsp;&nbsp;<b>'+data.country+'</b></div>';
                    }
                }
            });
    }
    $(document).ready(function () {
        setTimeout(function () {
            typeaheadCountries();
        },1000);
        $('#search_countries').on('typeahead:selected', function(evt, item) {
            $('#show_details').hide();
            var google_search = "https://www.google.com/search?q="+item.country;
            $.get('../country'+'?search=' + item.country, function(response) {
                if(response){
                  $('#show_details').show();
                  $('#country_image').attr('src',response.file_url);
                  $('#show_description').html('<h2>'+response.name+'</h2><h6>More on: <a target="_blank" href="https://wikipedia.org'+response.url+'">Wiki</a></h6><h6>More on: <a target="_blank" href="'+google_search+'">Google</a></h6>');
                }
            });
            $('#search_countries').typeahead('val', item.country)
        })
    });