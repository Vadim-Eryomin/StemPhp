<div class="card-container">
</div>
<script type="text/javascript">
    let needSize = Math.min(document.body.clientWidth, document.body.clientHeight) * 0.5;
    $(".card-container").bind("DOMSubtreeModified", function(){
        $(".center-image").each(function(){
            let image = $(this);
            let width = image.width();
            let height = image.height();
            if(height > width && height > needSize)
                image.height(needSize);
            else if(width > needSize){
                image.height("");
                image.width(needSize);
            }
        });        
    });

    let createForm = function(src, text){

        let container = document.createElement('div');
        container.setAttribute('class', 'vk-card');

        let img = document.createElement('img');
        img.src = src;
        img.setAttribute('class', 'center-image');

        let textDiv = document.createElement('div');
        textDiv.textContent = text;
        textDiv.setAttribute('class', 'vk-card-text');;

        container.appendChild(img);
        container.appendChild(textDiv);

        return container;
    }
    VK.init({
        apiId: 7193860
    });
    VK.Api.call('wall.get', { owner_id: -113376999, v: '5.73', count: 10 }, function (r) {
        let content = document.body.querySelector('.container').querySelector('.content').querySelector('.card-container');
        let textRawData, textData, finalText;
        if (r.response) {
            let form, image;
            for(let i = 0; i < 10; i++){
                textRawData = r.response.items[i].text;
                textRawData = textRawData.replace("/\n/gi", "<br>");
                textData = textRawData.split(" ");
                finalText = "";
                for(let i = 0; i < (textData.length > 50 ? 50 : textData.length); i++) finalText += textData[i] + " ";

                container = createForm(r.response.items[i].attachments[0].type === 'photo' ? r.response.items[i].attachments[0].photo['photo_807'] : "image/just.png", finalText);
                content.appendChild(container);
            }
        }
    });
</script>