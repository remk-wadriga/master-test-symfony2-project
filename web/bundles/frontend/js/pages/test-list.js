TestList = {

    testTypeGetFormUrl: '',

    selectTypeButtonId: '#create-new-test',

    init: function(data){
        if(typeof data != 'undefined'){
            var attributes = [
                'testTypeGetFormUrl'
            ];

            $.each(attributes, function(index, element){
                if(typeof data[element] != 'undefined')
                    TestList[element] = data[element];
            });
        }

        TestList.setHandlers();
    },

    setHandlers: function(){
        //TestList.selectTextType();
    },

    // Handlers

    selectTextType: function(){
        $(TestList.selectTypeButtonId).on('click', function(){
            Main.openPopup();
            Main.ajx({
                url: TestList.testTypeGetFormUrl,
                success: function(json){
                    console.log(json);
                }
            })
        });
    }

    // AND Handlers


    // Functions

    // END Functions

};