class dropDown {

    expand(li){

        $('#main_nav li').each(function(){
            $(this).removeClass('ddSelected');
        });

        $('#mob_navigation li').each(function(){
            $(this).removeClass('ddSelected');
        });

        $('#heroImg').css('height', '0px').css('padding-top', '0px');
        $('#makeup_nav').css('height', '0px').css('padding-top', '0px');
        $('#skincare_nav').css('height', '0px').css('padding-top', '0px');
        $('#hair_nav').css('height', '0px').css('padding-top', '0px');

        this.dropdown.css('height', this.navHeight).css('padding-top', this.padding);
        li.addClass(this.selectedClass);

    }

    collapse(li){

        this.dropdown.css('height', '0px').css('padding-top', '0px');
        li.removeClass(this.selectedClass);

    }

    addListerners(navBtn, selected, dropdown){

        const thisClass = this;

        navBtn.on('click', function(){

            if($(this).hasClass(selected)){

                thisClass.collapse($(this));

            }else{

                thisClass.expand($(this));

            }

        });
    }

    constructor(navBtn, dropdown, navHeight, padding){
        this.navBtn = navBtn;
        this.dropdown = dropdown;
        this.selectedClass = 'ddSelected';
        this.navHeight = navHeight;
        this.padding = padding;
        this.addListerners(this.navBtn, this.selectedClass, this.dropdown);
    }

}

class Popup {

    popUp(message, customform){

        let modal = '<div class="c_modal">';
        modal += '<div class="box">';
        modal += '<p>' + message + '</p>';

        if(customform !== undefined){
            modal += customform;
        }else{
            modal += '<button id="yes_btn">Yes</button>';
            modal += '<button id="no_btn">No</button>';
        }

        modal += '</div>';
        modal += '</div>';

        $('body').append(modal);

        const thisClass = this;

        $('.c_modal').on('click', function(e){

            if($(e.target).is('.box') || $(e.target).is('button') || $(e.target).is('input')){
                e.preventDefault();
                return;
            }

            thisClass.popDown();
            
        });

    }

    popDown(){

        $('.c_modal').remove();
        $('.c_modal').off();

    }

    constructor(positiveFunc, negativeFunc){
        this.positiveFunc = positiveFunc;
        this.negativeFunc = negativeFunc;
    }

}

