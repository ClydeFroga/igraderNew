document.addEventListener('DOMContentLoaded', () => {

    function load(e) {
        jQuery(function($){
            e.target.textContent = 'Загружаю...'
            let num = e.target.dataset.load;

            let data = {
                'action': 'loadmore',
                'block': loadmore_params.block[num],
                'query': loadmore_params.posts[num],
                'offset': loadmore_params.offset[num],
                'perView': loadmore_params.perView[num],
                'horizontalBar': loadmore_params.horizontalBar[num],
                'verticalBar': loadmore_params.verticalBar[num],
                'nonce': loadmore_params.nonce
            };

            let insert = e.target.previousElementSibling;

            $.ajax({
                url:loadmore_params.ajaxurl,
                data:data,
                type:'POST',
                success:function(data){
                    if( data ) {
                        $(insert).after(data);
                        e.target.textContent = 'Загрузить ещё ↓'
                        loadmore_params.offset[num] += loadmore_params.perView[num];
                    }
                    else {
                        e.target.textContent = 'Записи закончились'
                        setTimeout(() => e.target.remove(), 5000)
                    }
                },
            })
        })
    }
    
    let loadmores = document.querySelectorAll('#loadMore')
    
    if (loadmores.length > 0) {
        for (let item of loadmores) {
            item.addEventListener('click', load)
        }
    }
    
    jQuery(function($){
        $('#eventsLoad').click(function(){
            this.innerText = 'Загружаю...'
            let data = {
                'action': 'events',
            };
            let insert = this.previousElementSibling;

            $.ajax({
                url:loadmore_params.ajaxurl,
                data:data,
                type:'POST',
                success:function(data){
                    if( data ) {
                        $(insert).after(data);
                    }
                },
                complete: function () {
                    $('#eventsLoad').remove()
                }
            });
            
        });
    });
    
    jQuery(function($){
        $('#archiveLoad').click(function(){
            $(this).text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
            let  data = {
                'action': 'archiveloadmore',
                'offset': offset,
            };
            $.ajax({
                url:loadmore_params.ajaxurl, // обработчик
                data:data, // данные
                type:'POST', // тип запроса
                success:function(data){
                    if( data ) {
                        $('#archiveLoad').text('Загрузить ещё')
                        $('.magArchive__part2').append(data);
                        offset += 9;
                    } else {
                        $('#archiveLoad').remove();
                    }
                }
            });
        });
    });
    
    jQuery(function($){
        $('#loadMorePopular').click(function(){
            $(this).text('Загружаю...'); // изменяем текст кнопки, вы также можете добавить прелоадер
            let data = {
                'action': 'loadMorePopular',
                'offset': popularOffset,
            };
            let insert = this.previousElementSibling;
            $.ajax({
                url:loadmore_params.ajaxurl, // обработчик
                data:data, // данные
                type:'POST', // тип запроса
                success:function(data){
                    if(data === '<p class="wpp-no-data">Извините. Данных пока нет.</p>') {
                        $('#loadMorePopular').remove();
                    }
                    if( data ) {
                        $('#loadMorePopular').text('Загрузить ещё')
                        $(insert).after(data);
                        popularOffset += 9;
                    }
                }
            });
        });
    });
})