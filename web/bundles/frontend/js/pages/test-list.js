TestList = {

    selectTypeButtonId: '#create-new-test',

    init: function(data){
        if(typeof data != 'undefined'){
            var attributes = [

            ];

            $.each(attributes, function(index, element){
                if(typeof data[element] != 'undefined')
                    TestList[element] = data[element];
            });
        }

        TestList.setHandlers();
    },

    setHandlers: function(){
        TestList.selectTextType();
    },

    // Handlers

    selectTextType: function(){
        $(TestList.selectTypeButtonId).on('click', function(){
            Main.openPopup();
        });
    }

    // AND Handlers


    // Functions

    // END Functions

};