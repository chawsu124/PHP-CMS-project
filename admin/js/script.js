// confirm delete post
$(function(){ // in vew_all_posts confirm delete
    $('.delete_post').click(function(){
        return confirm("Are you sure to delete?");
    })
})


// confirm delte category
$(function(){
    $('.confirm_delete').click(function(){
        return confirm('Are you sure You want to Delete?');
    });
})


// check all box
$(function(){
    $('.checkAllBox').click(function(){ // if you click checkbox from tabel header
        if(this.checked == true){
            $('.checkBoxes').each(function(){ // all td checkboxes are checked
                this.checked = true;
            })
        }else{
            $('.checkBoxes').each(function(){
                this.checked = false;
            })
        }
    })
})

// 