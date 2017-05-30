var speed = 300;
var srcItemBanner = "/uploads/pro_image/";
var positionItemMinBanner = 0;
var positionItemMaxBanner = 0;
var idListItemBanner = "#list_item";
var positionItemMinProduct = 0;
var positionItemMaxProduct = 5;
var idListItemProduct = "#list_item_right";
var numberDisplayItemProduct = 4;
var positionItemMinProductEnd = 0;
var positionItemMaxProductEnd = 4;
var positionItemMinHome = 0;
var positionItemMinHome2 = 0;
var positionItemMaxHome2 = 5;
var positionItemMaxHome = 5;
var numberDisplayItemHome = 4;
var numberOfItemHome;
var positionPro = 1;
var idListItemProductEnd = "#list_item_product";
var idListItemHome = "#list_item_product";
var idItemProductEnd = "#list_item_product_img";
var idItemHome = "#list_item_home_img";
var numberDisplayItemProductEnd = 3;
var numberDisplayItemBanner = 1;
var idItemBanner = "#img";
var idItemProduct = "#list_item_right_img";
var click = false;
var timeOutMove;
var positionLagre;
var idPrice = "#list_item_product_price";
var positionVote = -1;
var srcItemCart;
var numberOfItemCart;
var listItem = new Array();
var price;
var checkExistItem = false;
var flagRegister = true;
var flagAvatar = false;
var positionMenuAdmin = 0;
var usernameAdmin = "";
var fullnameAdmin = "";
var abc = new Array();
var checkSubmit;
var listProduct = new Array();
var listHot = new Array();
var listTemp = new Array();
var listProductOfCat = new Array();
$(function () {

    $(document).on("click", ".remove_tag", function () {
        var index = $(".remove_tag").index(this);
        $(".insert_tag").eq(index).remove();
    });

    // $("#form_add_news").submit(function () {
    //     var res = true;
    //     var list = $(".input_form");
    //     var err = $(".new_err");
    //     list.each(function (index, object) {
    //
    //         if ($.trim($(object).val()).length < 20) {
    //             res = false;
    //             err.eq(index).text("Nhập tối thiểu 20 kí tự");
    //         }
    //         else
    //             err.eq(index).text("");
    //     });
    //     if (!flagAvatar)
    //         res = false;
    //     return res;
    // });

    loadAllProduct();
    loadProductHot();
    $("#search").submit(function () {
        var search = $.trim($( "#inputTex").val()).length >0;
        if (search )
            return true;
        else {
            alert("Bạn chưa nhập từ khóa.");
            return false;
        }
    });
    $("#form_edit_pro").submit(function () {

        return validateFormEditPro();
    });

    $("#form_add_pro").submit(function () {

        return validateFormAddPro();
    });

    $("form_add_cat").submit(function () {

        return validateFormAddCat();
    })


    $("#form_edit").submit(function () {
        // var id = getCookie("user_id");
        var fullname = $('#input_name').val();
        var id = $('#input_id').val();
        var address = $('#input_address').val();
        var birthday = getBirthday();
        var gender = ($("#male").prop("checked")) ? 0 : 1;
        var description = $('#input_note').val();
        var phone = $("#input_phone_number").val();
        var role = $("#role").val();
        if (validateEdit()) {
            var form_data = new FormData();
            if (!$("#bt_choose_ava").val() == "") {
                var file_data = $("#bt_choose_ava").prop("files")[0];
                form_data.append("use_avatar", file_data);
            }
            form_data.append("use_fullname", fullname);
            form_data.append("use_address", address);
            form_data.append("use_birthday", birthday);
            form_data.append("use_description", description);
            form_data.append("use_phone_number", phone);
            form_data.append("use_role", role);
            form_data.append("use_id", id);
            form_data.append("use_gender", gender);
            $.ajax({
                url: "/php/editUser.php",
                dataType: 'text',
                enctype: "multipart/form-data",
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (res) {
                    alert(res)
                    var result = JSON.parse(res);
                    if (result["code"] == 200) {
                        alert("Chỉnh sửa thành công");
                        window.location = "/admin/users";

                    } else
                        alert(result["message"]);
                }
            });
        }
        return false;
    });
    $(document).on("click", ".use_active0", function () {
        var index = $(".use_active0").index(this);
        var id = listAccount[index]["use_id"];
        var role = listAccount[index]["use_role"];
        $.ajax({
            url: "/php/active.php",
            type: "post",
            dataType: "text",
            data: {
                use_id: id,
                use_role: role,
                address: 0
            },
            success: function (result) {
                var res = JSON.parse(result);
                if (res["code"] == 200)
                    window.location.reload();
                else
                    alert(res["message"]);
            }
        });
    });
    $(document).on("click", ".use_active1", function () {
        var index = $(".use_active1").index(this);
        var id = listAccount[index]["use_id"];
        var role = listAccount[index]["use_role"];
        $.ajax({
            url: "/php/active.php",
            type: "post",
            dataType: "text",
            data: {
                use_id: id,
                use_role: role,
                address: 0
            },
            success: function (result) {
                var res = JSON.parse(result);
                if (res["code"] == 200)
                    window.location.reload();
                else
                    alert(res["message"]);

            }
        });
    });

    $("#logout_admin").click(function () {
        $.ajax({
            url: "/php/logout.php",
            type: "post",
            dataType: "text",
            data: {},
            success: function () {
                window.location = "/home/login.php"
            }
        });
    });
    loadHeightContent();
    $(document).on("click", '.use_delete', function () {
        var index = $(".bt_delete").index(this);
        var use_id = listAccount[index]["use_id"];
        var use_role = listAccount[index]["use_role"];
        if (confirm("Bạn chắc chắn muốn xóa?") == true) {
            $.ajax({
                url: "/php/delete_user.php",
                type: "post",
                dateType: "text",
                data: {
                    use_id: use_id,
                    use_role: use_role
                },
                success: function (result) {
                    var temp = JSON.parse(result);
                    alert(temp["message"]);
                    if (temp["code"] == 200) {
                        window.location.reload();
                    }
                }
            });
        } else {
        }

    })
    // if (getCookie(""))
    loadListUsers();
    $(".menu_admin").click(function () {
        var index = $(".menu_admin").index(this);
        switch (index) {
            case 0:
                window.location = "/admin";
                break;
            case 8:
                window.location = "/admin/users";
                break;
            case 9:
                window.location = "/admin/categories";

                break;
            case 10:
                window.location = "/admin/product";
                break;
            case 11:
                window.location = "/admin/news";
                break;
            case 12:
                window.location = "/admin/tags";
            default:
                if (index != positionMenuAdmin) {
                    $(".menu_admin").eq(positionMenuAdmin).removeClass("active_admin");
                    $(".menu_admin").eq(index).addClass("active_admin");
                    positionMenuAdmin = index;

                }

        }
    });
    $("#form_login").submit(function () {
        if (validateLogin()) {
            submitLogin();
        }
        return false;
    });

    $("#home_login").click(function () {
        // alert($.trim($("#home_login >a>span").text()));
        if ($.trim($("#home_login >a>span").text()) == "Login") {
            window.location = "/home/login.php";
        }
        else {
            $.ajax({
                url: "/php/logout.php",
                type: "post",
                dateType: "text",
                data: {},
                success: function (result) {
                    window.location.reload();
                }
            });
        }
    });
    // $("#submit_login")

    $("#image_new").change(function () {
        if (this.files[0].size < 1024 * 1024) {
            var reader = new FileReader();
            var image = new Image();
            reader.onload = function (e) {
                image.src = e.target.result;
                image.onerror = function () {
                    $("#img_news_err").text("File bạn chọn không phải là ảnh");
                    $("#img_news").removeAttr("src");
                    $("#img_news").val("");
                    $("#img_news").css("display", "none");
                    flagAvatar = false;
                };
                image.onload = function () {
                    $("#img_news").attr("src", e.target.result);
                    $("#img_news_err").text("");
                    $("#img_news").css("display", "block");
                    flagAvatar = true;
                }

            };
            reader.onerror = function () {
                console.log(1234);
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            flagAvatar = false;
            $("#img_news_err").text("File bạn chọn vượt quá kích thước cho phép (1MB)");
            $("#img_news").removeAttr("src");
            $("#image_new").val("");
            $("#img_news").css("display", "none");
        }
    });

    $("#choose_ava_pro").change(function () {
        if (this.files[0].size < 1024 * 1024) {
            var reader = new FileReader();
            var image = new Image();
            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                // $("#img_avatar").attr("src", e.target.result);
                //     $("#register_avatar_error").text("");
                //     $("#input_avatar").css("display", "block");
                image.src = e.target.result;
                image.onerror = function () {
                    $("#choose_ava_pro_err").text("File bạn chọn không phải là ảnh");
                    $("#ava_product").removeAttr("src");
                    $("#ava_product").val("");
                    $("#ava_product").css("display", "none");
                    flagAvatar = false;
                };
                image.onload = function () {
                    $("#ava_product").attr("src", e.target.result);
                    $("#choose_ava_pro_err").text("");
                    $("#ava_product").css("display", "block");
                    flagAvatar = true;
                }

            };
            reader.onerror = function () {
                console.log(1234);
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            flagAvatar = false;
            $("#choose_ava_pro_err").text("File bạn chọn vượt quá kích thước cho phép (1MB)");
            $("#ava_product").removeAttr("src");
            $("#choose_ava_pro").val("");
            $("#ava_product").css("display", "none");
        }
    });
    $("#bt_choose_ava").change(function () {
        if (this.files[0].size < 1024 * 1024) {
            var reader = new FileReader();
            var image = new Image();
            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                // $("#img_avatar").attr("src", e.target.result);
                //     $("#register_avatar_error").text("");
                //     $("#input_avatar").css("display", "block");
                image.src = e.target.result;
                image.onerror = function () {
                    $("#register_avatar_error").text("File bạn chọn không phải là ảnh");
                    $("#img_avatar").removeAttr("src");
                    $("#bt_choose_ava").val("");
                    $("#input_avatar").css("display", "none");
                    flagAvatar = false;
                };
                image.onload = function () {
                    $("#img_avatar").attr("src", e.target.result);
                    $("#register_avatar_error").text("");
                    $("#input_avatar").css("display", "block");
                    flagAvatar = true;
                }

            };
            reader.onerror = function () {
                console.log(1234);
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            flagAvatar = false;
            $("#register_avatar_error").text("File bạn chọn vượt quá kích thước cho phép (1MB)");
            $("#img_avatar").removeAttr("src");
            $("#bt_choose_ava").val("");
            $("#input_avatar").css("display", "none");
        }
    });
    loadTotalPrice();
    $("#1").focusout(function () {
        if ($.trim($(this).val()).length == 0) {
            $(this).val("Search entrie store here.");
            $(this).css("color", "#CCCCCC")
        }
    })
    $("#2").focusout(function () {
        if ($.trim($(this).val()).length == 0) {
            $(this).val("Enter your email address");
            $(this).css("color", "#CCCCCC")
        }
    })
    $("#submitEmail").click(function () {
        var em = $(".email input").val();
        if ($.trim(em).length == 0) {
            alert("Please enter your email");
            e.preventDefault();
        }
        if (!(validateEmail(em))) {
            alert("Error email form");
        }
        else {
            alert("Thank you");
            e.preventDefault();
        }
    });
    var index = 0,
        lastIndex = 0,
        $slide = $(".slideshow"),
        $dot = $(".dotE"),
        setInt;
    $slide.hide().eq(index).show();
    $dot.eq(index).css("border", "5px solid #919595");
    function fadefn(index, time) {
        fadeDot(index - 1);
        $slide.fadeOut(time).eq(index).stop().fadeIn(time);
    }

    function fadeDot(index1) {
        $dot.eq(index1 % 4).css("border", "5px solid #CCCCCC");
        $dot.eq((index1 + 1) % 4).css("border", "5px solid #919595");
    }

    function stopInt() {
        clearInterval(setInt);
    }

    function startInt() {
        setInt = setInterval(
            function () {
                index++;
                if (index > 3)
                    index = 0;
                lastIndex = index;
                fadefn(index, 3000)
            }, 6000);
    }

    $(".dotE").click(function () {
        index = $(".dotE").index(this);
        $slide.hide().eq(index).fadeIn(1000);
        $dot.css("border", "5px solid #CCCCCC").eq(index).css("border", "5px solid #919595");
    })
    $slide.hover(stopInt, startInt);
    startInt();
    $("#next").click(function () {
        index++;
        if (index > 3)
            index = 0;
        fadefn(index, 1000)
    })
    $("#back").click(function () {
        $dot.eq(index % 4).css("border", "3px solid #CCCCCC");
        index--;
        if (index < 0)
            index = 3;
        $dot.eq((index) % 4).css("border", "5px solid #919595");
        $slide.fadeOut(1000).eq(index).stop().fadeIn(1000);
    })
    var wtd = parseInt($(".it").css("width")) + 12;
    slideItem($("#backItem"), $(".it"), -wtd);
    slideItem($("#nextItem"), $(".it"), +wtd);
    slideItem($("#backItem1"), $(".itt"), -wtd);
    slideItem($("#nextItem1"), $(".itt"), +wtd);
    $(".mmenu").click(function () {
        $(".mmenu").removeClass("active");
        $(this).addClass("active");
    });
    $(".mmenu1").click(function () {
        $(".mmenu1").removeClass("active1");
        $(this).addClass("active1");
    });

    $("#banner_bt_next").click(function () {
        if (click == false) {
            click = true;
            clearTimeout(timeOutMove);
            timeOutMove = setTimeout(function () {
                click = false;
            }, speed);
            if (positionItemMinBanner == 0)
                positionItemMinBanner = listProduct.length - 1;
            else positionItemMinBanner--;
            nextItem(positionItemMinBanner, $(".banner_items"), srcItemBanner, 1, idItemBanner, idListItemBanner, "", "");
        }
    })

    $("#banner_bt_pre").click(function () {
        if (click == false) {
            click = true;
            clearTimeout(timeOutMove);
            timeOutMove = setTimeout(function () {
                click = false;
            }, speed);
            if (positionItemMaxBanner == listProduct.length - 1)
                positionItemMaxBanner = 0;
            else positionItemMaxBanner++;
            preItem(positionItemMaxBanner, $(".banner_items"), srcItemBanner, 1, idItemBanner, idListItemBanner, "", "");

        }
    })


    $(".list_item_right").click(function () {
        $(".list_item_right").removeClass("display");
        $(".list_item_right").eq($(".list_item_right").index(this)).addClass("display");
    });

    //vote
    $(".bt_vote").click(function () {
        var index = $(".bt_vote").index(this);
        // if (index == positionVote) {
        //     deleteVote();
        //     positionVote = -1;
        // } else {
        //
        //     positionVote = index;
        changeVote(index);
        // }
    });

    //tab
    $(".tab").click(function () {
        var index = $(".tab").index(this);
        $(".tab").removeClass("tab_choose");
        $(".tab").eq(index).addClass("tab_choose");
        displayTab(index);
    });

    // /add cart
    //


    // $(".bay").click(function () {
    //     var index = $(".bay").index(this);
    //     var src = $(idItemProductEnd + index).attr("src");
    //     var price = $(idPrice + index).text();
    //     var name = $("#name_pro" + index).text();
    //     addCart(src, 1, price, name);
    //     // alert(src)
    // });

    //delete

    $("#menu_card").hover(function () {
        $(".cart").remove();
        loadCart();
    }, function () {
        $(".cart").remove();
    });

    // $("#product_bt_next").click(function () {
    //     if (click == false) {
    //         click = true;
    //         clearTimeout(timeOutMove);
    //         timeOutMove = setTimeout(function () {
    //             click = false;
    //         }, speed);
    //         positionLagre = positionItemMinProduct;
    //         if (positionItemMinProduct == 0) {
    //             positionItemMinProduct = listProduct.length - 1;
    //         }
    //
    //         else {
    //             positionItemMinProduct--;
    //         }
    //         if (positionItemMaxProduct == 0)
    //             positionItemMaxProduct = listProduct.length - 1;
    //         else
    //             positionItemMaxProduct--;
    //         // if (positionItemMinProduct == numberOfItemProduct -1){
    //         //
    //         //     positionLagre = 0;
    //         // }
    //         // else
    //         //     positionLagre = positionItemMinProduct +1;
    //         if (listProduct.length > numberDisplayItemProduct) {
    //
    //             nextItem(positionItemMinProduct, $(".list_item_right"), srcItemBanner, numberDisplayItemProduct, idItemProduct, idListItemProduct);
    //             changeLargeItem(positionLagre);
    //         }
    //
    //     }
    // })

    // $("#product_bt_pre").click(function () {
    //     if (click == false) {
    //         click = true;
    //         clearTimeout(timeOutMove);
    //         timeOutMove = setTimeout(function () {
    //             click = false;
    //         }, speed);
    //         if (positionItemMaxProduct == listProduct.length - 1) {
    //             positionItemMaxProduct = 0;
    //         }
    //
    //         else {
    //             positionItemMaxProduct++;
    //         }
    //         if (positionItemMinProduct == listProduct.length - 1)
    //             positionItemMinProduct = 0;
    //         else
    //             positionItemMinProduct++;
    //
    //         if (positionItemMaxProduct >= numberDisplayItemProduct)
    //             positionLagre = positionItemMaxProduct - numberDisplayItemProduct;
    //         else
    //             positionLagre = positionItemMaxProduct - numberDisplayItemProduct + listProduct.length;
    //         if (listProduct.length > numberDisplayItemProduct) {
    //             preItem(positionItemMaxProduct, $(".list_item_right"), srcItemBanner, numberDisplayItemProduct, idItemProduct, idListItemProduct, "" +
    //                 "");
    //             changeLargeItem(positionLagre);
    //         }
    //     }
    // });

    $("#next_product_end").click(function () {
        var cat_id = $("#cat_id").val();
        $.ajax({
            url: "/php/getProductOfCat.php",
            type: "post",
            dataType: "text",
            data: {
                cat_id: cat_id
            },
            success: function (result) {
                var res = JSON.parse(result);
                if (res["code"] == 200) {
                    listProductOfCat = res["data"];
                    if (listProductOfCat == 0)
                        listProductOfCat = listProduct;
                    if (click == false) {
                        click = true;
                        clearTimeout(timeOutMove);
                        timeOutMove = setTimeout(function () {
                            click = false;
                        }, speed);
                        if (positionItemMinProductEnd == 0) {
                            positionItemMinProductEnd = listProductOfCat.length - 1;
                        }

                        else {
                            positionItemMinProductEnd--;
                        }
                        if (positionItemMaxProductEnd == 0)
                            positionItemMaxProductEnd = listProductOfCat.length - 1;
                        else
                            positionItemMaxProductEnd--;
                        if (listProductOfCat.length > numberDisplayItemProductEnd) {

                            nextItem(positionItemMinProductEnd, $(".list_item_product"), srcItemBanner, numberDisplayItemProductEnd, idItemProductEnd, idListItemProductEnd, "#name_pro", idPrice);
                        }

                    }
                }
                else
                    alert(res["message"]);

            }
        });

    });
    $("#pre_product_end").click(function () {
        var cat_id = $("#cat_id").val();
        $.ajax({
            url: "/php/getProductOfCat.php",
            type: "post",
            dataType: "text",
            data: {
                cat_id: cat_id
            }, success: function (result) {
                var res = JSON.parse(result);
                if (res["code"] == 200) {
                    listProductOfCat = res["data"];
                    if (listProductOfCat == 0)
                        listProductOfCat = listProduct;
                    if (click == false) {
                        click = true;
                        clearTimeout(timeOutMove);
                        timeOutMove = setTimeout(function () {
                            click = false;
                        }, speed);
                        if (positionItemMinProductEnd == listProductOfCat.length - 1) {
                            positionItemMinProductEnd = 0;
                        }

                        else {
                            positionItemMinProductEnd++;
                        }
                        if (positionItemMaxProductEnd == listProductOfCat.length - 1)
                            positionItemMaxProductEnd = 0;
                        else
                            positionItemMaxProductEnd++;
                        if (listProductOfCat.length > numberDisplayItemProductEnd) {
                            preItem(positionItemMaxProductEnd, $(".list_item_product"), srcItemBanner,
                                numberDisplayItemProductEnd, idItemProductEnd, idListItemProductEnd, "#name_pro", idPrice);
                        }
                    }
                }
                else
                    alert(res["message"]);

            }
        });
    });


    $("#pre_list_home").click(function () {

        if (click == false) {
            click = true;
            clearTimeout(timeOutMove);
            timeOutMove = setTimeout(function () {
                click = false;
            }, speed);
            if (positionItemMinHome == listHot.length - 1) {
                positionItemMinHome = 0;
            }

            else {
                positionItemMinHome++;
            }
            if (positionItemMaxHome == listHot.length - 1)
                positionItemMaxHome = 0;
            else
                positionItemMaxHome++;
            if (listHot.length > numberDisplayItemHome) {

                preItem(positionItemMaxHome, $(".list_item_home"), srcItemBanner, numberDisplayItemHome, idItemHome,
                    idListItemHome, "#name_pro", idPrice);
            }

        }
    })

    $("#next_list_home").click(function () {
        if (click == false) {
            click = true;
            clearTimeout(timeOutMove);
            timeOutMove = setTimeout(function () {
                click = false;
            }, speed);
            if (positionItemMinHome == 0) {
                positionItemMinHome = listHot.length - 1;
            }

            else {
                positionItemMinHome--;
            }
            if (positionItemMaxHome == 0)
                positionItemMaxHome = listHot.length - 1;
            else
                positionItemMaxHome--;
            if (listHot.length > numberDisplayItemHome) {
                nextItem(positionItemMinHome, $(".list_item_home"), srcItemBanner,
                    numberDisplayItemHome, idItemHome, idListItemHome, "#name_pro", idPrice);
            }
        }
    });

    $("#pre_list_home2").click(function () {
        if (click == false) {
            click = true;
            clearTimeout(timeOutMove);
            timeOutMove = setTimeout(function () {
                click = false;
            }, speed);
            if (positionItemMinHome2 == listProduct.length - 1) {
                positionItemMinHome2 = 0;
            }

            else {
                positionItemMinHome2++;
            }
            if (positionItemMaxHome2 == listProduct.length - 1)
                positionItemMaxHome2 = 0;
            else
                positionItemMaxHome2++;
            if (listProduct.length > numberDisplayItemHome) {

                preItem(positionItemMaxHome2, $(".list_item_home2"), srcItemBanner, numberDisplayItemHome, idItemHome + "2",
                    idListItemHome, "#name_pro2", idPrice + "2");
            }

        }
    })

    $("#next_list_home2").click(function () {
        if (click == false) {
            click = true;
            clearTimeout(timeOutMove);
            timeOutMove = setTimeout(function () {
                click = false;
            }, speed);
            if (positionItemMinHome2 == 0) {
                positionItemMinHome2 = listProduct.length - 1;
            }

            else {
                positionItemMinHome2--;
            }
            if (positionItemMaxHome2 == 0)
                positionItemMaxHome2 = listProduct.length - 1;
            else
                positionItemMaxHome2--;
            if (listProduct.length > numberDisplayItemHome) {
                nextItem(positionItemMinHome2, $(".list_item_home2"), srcItemBanner,
                    numberDisplayItemHome, idItemHome + "2", idListItemHome, "#name_pro2", idPrice + "2");
            }
        }
    });
    $("#form_review").submit(function () {
        return validateForm();
    });
    $("#form_register").submit(function () {
        return validateRegister();
    });
    // $("#submit_register").click(function () {
    // });
    $("#newsletter_input_email").change(function () {
        // alert(this.id)
        if (!checkEmail($("#newsletter_input_email").val())) {
            $("#newsletter_input_email_error").text("Email nhập sai");
            $("#newsletter_input_email_true").css("display", "none");
        } else {
            $("#newsletter_input_email_error").text("");
            $("#newsletter_input_email_true").css("display", "inline-block");
        }
    });
    $(document).on("click", '.bt_delete_item', function () {

        var index = $(".cart").index(this);
        // alert(index)
        deleteItem($(".img_cart").eq(index).attr("src"));
        $(".cart").eq(index).remove();

    })
});

var checksum = 0;
function slideItem(bt, Group, param) {
    bt.click(function () {
        if (param > 0 && checksum == 0)
            animateNext(Group, param);
        else if (param < 0 && checksum == 0)
            animateBack(Group, param);
    })
};
function animateNext(group, param) {
    checksum = 1;
    group.each(function (i, e) {
        $(e).animate(
            {
                left: parseInt($(e).css("left")) + param,
            }, 350, function () {
                if (parseInt($(e).css("left")) > (param * 4 + 100)) {
                    $(e).css("left", "-252px");
                }
                checksum = 0;
            }
        );
    });
}
function animateBack(group, param) {
    group.each(function (i, e) {
        checksum = 1;
        $(e).animate(
            {
                left: parseInt($(e).css("left")) + param,
            }, 350, function () {
                if (parseInt($(e).css("left")) < (param - 100)) {
                    $(e).css("left", "1008px");
                }
                checksum = 0;
            }
        );
    });
}
function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test(email);
}
function nextItem(position, listItem, srcItem, maxItemDisplay, id, idList, idName, idPrice) {
    if (id == idItemHome) {

        listTemp = listProduct;
        listProduct = listHot;
    }
    if (id == idItemProductEnd) {
        listTemp = listProduct;
        listProduct = listProductOfCat;
    }
    var widthItem = parseFloat(listItem.eq(0).css("width"));
    var widthContainer = parseFloat($(idList).css("width"));
    var paddingItem;
    if (maxItemDisplay == 1)
        paddingItem = widthContainer - widthItem;
    else paddingItem = ((widthContainer) - widthItem * maxItemDisplay) / (maxItemDisplay - 1);

    listItem.each(function (index, object) {
        var item = $(object);
        item.animate({left: "+=" + getLeftItem(1, paddingItem, widthItem)}, speed, function () {

            if (parseInt(item.css("left")) > getLeftItem(maxItemDisplay, paddingItem, widthItem)) {
                item.css("left", getLeftItem(-1, paddingItem, widthItem));

                $(id + index).attr("src", srcItem + listProduct[position]["pro_image"]);
                $(idPrice + index).text(listProduct[position]["pro_price"]);
                $(idName + index).text(listProduct[position]["pro_name"]);
                if (id == idItemHome + "2") {
                    $("#bay" + index).attr("onclick", "addCart(" + listProduct[position]["pro_id"] + ",1)");
                    $("#go_product2_" + index).attr("onclick", "goProducts(" + listProduct[position]["pro_id"] + ")");
                }
                if (id == idItemProductEnd) {
                    $("#bay_end" + index).attr("onclick", "addCart(" + listProduct[position]["pro_id"] + ",1)");
                    $("#go_product_end" + index).attr("onclick", "goProducts(" + listProduct[position]["pro_id"] + ")");
                }
                if (id == idItemHome) {
                    $("#bay_home" + index).attr("onclick", "addCart(" + listProduct[position]["pro_id"] + ",1)");
                    $("#go_product_" + index).attr("onclick", "goProducts(" + listProduct[position]["pro_id"] + ")");

                }
                if (id == idItemProduct) {
                    var pos = (position == listProduct.length - 1) ? 0 : position + 1;
                    $("#bt_add_cart").attr("onclick", "btAddCart(" + listProduct[pos]["pro_id"] + ")");
                }
            }
            if (id == idItemProduct)
                changeBorder();
            if (id == idItemHome) {
                listProduct = listTemp;
            }
            if (id == idItemProductEnd) {
                listProduct = listTemp;
            }
        })
    });
}
function preItem(position, listItem, srcItem, maxItemDisplay, id, idList, idName) {
    // alert(123)
    var widthItem = parseFloat(listItem.eq(0).css("width"));
    var widthContainer = parseFloat($(idList).css("width"));
    var paddingItem;
    if (maxItemDisplay == 1)
        paddingItem = widthContainer - widthItem;
    else paddingItem = ((widthContainer) - widthItem * maxItemDisplay) / (maxItemDisplay - 1);

    listItem.each(function (index, object) {
        var item = $(object);
        item.animate({left: "-=" + getLeftItem(1, paddingItem, widthItem)}, speed, function () {
            if (parseInt(item.css("left")) < getLeftItem(-1, paddingItem, widthItem)) {
                item.css("left", getLeftItem(maxItemDisplay, paddingItem, widthItem));
                $(id + index).attr("src", srcItem + listProduct[position]["pro_image"]);
                $(idPrice + index).text(listProduct[position]["pro_price"]);
                $(idName + index).text(listProduct[position]["pro_name"]);
                if (id == idItemHome + "2") {
                    $("#bay" + index).attr("onclick", "addCart(" + position + ",1)");
                    $("#go_product2_" + index).attr("onclick", "goProducts(" + listProduct[position]["pro_id"] + ")");
                }
                if (id == idItemProductEnd) {
                    $("#go_product_end" + index).attr("onclick", "goProducts(" + listProduct[position]["pro_id"] + ")");

                    $("#bay" + index).attr("onclick", "addCart(" + position + ",1)");
                }
                if (id == idItemHome) {
                    $("#bay_home" + index).attr("onclick", "addCart(" + position + ",1)");
                    $("#go_product_" + index).attr("onclick", "goProducts(" + listProduct[position]["pro_id"] + ")");
                }
                if (id == idItemProduct) {
                    var pos = (positionItemMinProduct == listProduct.length - 1) ? 0 : positionItemMinProduct + 1;
                    $("#bt_add_cart").attr("onclick", "btAddCart(" + listProduct[pos]["pro_id"] + ")");
                }
            }
            if (id == idItemProduct)
                changeBorder();
        })
    });
}
function getLeftItem(position, paddingItem, widthItem) {
    return position * (widthItem + paddingItem);
}
function changeLargeItem(position) {
    positionPro = position;
    $("#price_item_large").text(listProduct[position]["pro_price"]);
    $("#item_large>img").attr("src", srcItemBanner + listProduct[position]["pro_image"]);
}
function changeBorder() {
    var list = $(".list_item_right");

    list.each(function (index, object) {
        var item = $(object);
        var left = parseInt(item.css("left"));
        if (left == 0) {
            item.addClass("display");

        }
        else
            item.removeClass("display");

    })
}
function changeVote(position) {
    $(".bt_vote").each(function (index, object) {
        var vote = $(object)
        if (index <= position) {
            if (!vote.hasClass("vote")) {
                vote.addClass("vote");
            }
        }
        else if (vote.hasClass("vote")) {
            vote.removeClass("vote");
        }
    });
}
function deleteVote(position) {
    $(".bt_vote").removeClass("vote");
}
function displayTab(index) {
    $(".content_tab").removeClass("tab_display");
    $(".content_tab").eq(index).addClass("tab_display");
}
function addItem(src, price, value, name) {
    var strCart = "<li class='cart'>" +
        "<a href='#asda'>" +
        "<div class='itemincard'>" +
        "<div class='de'>" +
        "<div class='igItem'>" +
        "<a href='#As'><img class='img_cart' src='" +
        src +
        "'></a>" +
        "</div>" +
        "<div class='detail'>" +
        "<a href='#12'><p>" +
        name +
        "</p></a>" +
        "<a href='#12'><p>" +
        value +
        " x " +
        numberWithCommas(price) +
        " = " +
        numberWithCommas(parseInt(value) * parseInt(price)) +
        " VNĐ" +
        "</p></a>" +
        "</div>" +
        "<div class='cancel'>" +
        "<div title='delete' class='bt_delete_item'><i class='fa fa-times' aria-hidden='true'></i></div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</a>" +
        "</li>";
    return strCart;
}

function Item() {
    this.name = "";
    this.src = "";
    this.price = "";
    this.values = 0;

    this.setInfo = function (src, price, values, name) {
        this.src = src;
        this.price = price;
        this.values = values;
        this.name = name;
    };

    this.addValues = function (values) {

        this.values += values;
    }

    this.getName = function () {
        return this.name;
    }

    this.getSrc = function () {
        return this.src;
    }
    this.getValues = function () {
        return this.values;

    }
    this.getPrices = function () {
        return this.price;
    }
    return this;
}
// function getCookie(key) {
//     $.cookie
// }
function loadCart() {
    // $("#sub_menu1").css("display", "none");
    if (getCookie("my_cookie") != "") {
        // alert(getCookie("my_cookie"))
        var strJson = getCookie("my_cookie");
        var listItem = JSON.parse(strJson);
        if (listItem.length == 0) {
            $("#no_item").text("Bạn chưa chọn sản phẩm nào");
        } else {
            $("#no_item").text("");
            for (var i = 0; i < listItem.length; i++) {
                $("#add_item").after(addItem(listItem[i]["src"], listItem[i]["price"], listItem[i]["values"], listItem[i]["name"]));
            }
        }
    }
    // $("#sub_menu1").css("display", "block");
}

function validateNickname() {
    var nickname = $("#input_nickname").val();
    var nickname_error = $("#input_nickname_error");
    if (nickname.length < 6 || nickname.length > 12) {
        nickname_error.text("Nickname có từ 6 đến 12 kí tự");
    } else {
        nickname_error.text("");
    }
}
function validateSummary() {
    var summary_error = $("#input_summary_error");
    var summary = $("#input_summary").val();
    if (summary.length < 6 || nickname.length > 12) {
        summary_error.text("Nickname có từ 6 đến 12 kí tự");
    } else {
        summary_error.text("");
    }
}
function validateReview() {
    var review_error = $("#review_text_error");
    var review = $("#review_text").val();
    if (review.length > 30) {
        review_error.text("Nhập tối đa 30 kí tự");
    } else {
        review_error.text("");
    }
}
function validateForm() {
    var flag = true;
    var nickname = $("#input_nickname").val();
    var summary = $("#input_summary").val();
    var review = $("#review_text").val();
    var nickname_error = $("#input_nickname_error");
    var summary_error = $("#input_summary_error");
    var review_error = $("#review_text_error");
    if (nickname.length < 6 || nickname.length > 12) {
        flag = false;
        nickname_error.text("Nickname có từ 6 đến 12 kí tự");
    } else {
        nickname_error.text("");
    }

    if (summary.length < 6 || nickname.length > 12) {
        flag = false;
        summary_error.text("Nickname có từ 6 đến 12 kí tự");
    } else {
        summary_error.text("");
    }

    if (review.length > 30) {
        flag = false;
        review_error.text("Nhập tối đa 30 kí tự");
    } else {
        review_error.text("");
    }
    return flag;
}
function checkEmail(email) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email)) {
        return false;
    }
    else
        return true;

}

function checkNumber() {

    var flag = true;
    var values = $("#number_of_item").val();
    var error = $("#number_of_item_error");
    var filter = /^([0-9 \.\-])+$/;
    if (filter.test(values)) {
        values = parseInt(values);
        if (values <= 0) {
            error.text("Bạn cần nhập số lượng chính xác");
            flag = false;
        } else {
            error.text("");
        }
        return flag;

    }
    else {
        error.text("Bạn cần nhập số lượng chính xác");
        return false;
    }
}
function deleteItem(src) {
    var strJson = getCookie("my_cookie");
    // alert(strJson)
    var listItem = JSON.parse(strJson);
    var index;
    for (var i = 0; i < listItem.length; i++) {
        if (listItem[i]["src"] == src) {
            index = i;
            break;
        }

    }
    // alert(index)
    listItem.splice(index, 1);
    var jsonStr = JSON.stringify(listItem);
    setCookie("my_cookie", jsonStr, 1);
    loadTotalPrice()
}
function validate(id) {
    switch (id) {
        case "#number_of_item":
            checkNumber();
            break;
        case "#form_review":
            validateForm();
            break;
        case "#input_nickname":
            validateNickname();
            break;
        case "#input_summary":
            validateSummary();
            break;
        case "#review_text":
            validateReview();
            break;
    }
}
function addCart(id, numberOfItemCart) {
    var i;
    var position = 0;
    for (i = 0; i < listProduct.length; i++) {
        if (listProduct[i]["pro_id"] == id)
            position = i;
    }
    var srcItemCart = srcItemBanner + listProduct[position]["pro_image"];
    var name = listProduct[position]["pro_name"];
    var price = listProduct[position]["pro_price"];
    var listItem = new Array();
    if (getCookie("my_cookie") != "") {
        var strJson = getCookie("my_cookie");
        var listItem = JSON.parse(strJson);
        for (var i = 0; i < listItem.length; i++) {
            if (listItem[i]["src"] == srcItemCart) {
                listItem[i]["values"] += numberOfItemCart;
                checkExistItem = true;
            }
        }
        if (checkExistItem == false) {
            var item = new Item();
            item.setInfo(srcItemCart, price, numberOfItemCart, name)
            listItem.push(item);

        }
        checkExistItem = false;
    } else {
        var item = new Item();
        item.setInfo(srcItemCart, price, numberOfItemCart, name);
        listItem.push(item);
    }
    var jsonStr = JSON.stringify(listItem);
    setCookie("my_cookie", jsonStr, 1);
    loadTotalPrice();
    alert("Bạn đã thêm sản phẩm thành công");
}
function loadTotalPrice() {
    if (getCookie("my_cookie") != "") {
        var total = 0;
        var strJson = getCookie("my_cookie");
        // alert(strJson)
        var listItem = JSON.parse(strJson);
        for (var i = 0; i < listItem.length; i++) {
            total += parseInt(listItem[i]["price"]) * parseInt(listItem[i]["values"]);
        }
        $("#total_price").text(numberWithCommas(total))
    }
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}
function loadJson() {
    $.get("/json/storeUser.php", function (data) {
        return data;
    })
}

function validateRegister() {
    flagRegister = true;
    if (!checkEmpty()) {

        flagRegister = false;
    }
    if (!validateMail())
        flagRegister = false;
    if (!validateUsername())
        flagRegister = false;
    if (validatePassword()) {
        if (!validateRetypePassword())
            flagRegister = false;
    } else {
        flagRegister = false;
    }
    if (!validatePhoneNumber())
        flagRegister = false;
    if (!validateBirthday($("#day").val(), $("#month").val(), $("#year").val()))
        flagRegister = false;
    if (!checkEmptyAvatar())
        flagRegister = false;
    // if (!flagAvatar)
    //     flagRegister = false;
    if (flagRegister)
        $("#input_birthday").val(getBirthday());
    return flagRegister;
}
function checkWordSpecil(str) {
    var filter = /^([0-9a-zA-Z /_])+$/;
    return filter.test(str)
}
function checkLengh(id, message) {
    if (($.trim($("#input_" + id).val()).length) > 8 && ($.trim($("#input_" + id).val()).length) < 15) {
        $("#register_" + id + "_error").text("");
        $("#register_" + id + "_true").removeClass("register_validate");
        return true;
    } else {
        $("#register_" + id + "_error").text("Nhập " + message + " từ 8 đến 20 kí tự");
        $("#register_" + id + "_true").addClass("register_validate");
        return false;
    }

}
function checkEmpty() {
    var flag = true;
    $(".register_input").each(function (index, object) {
        var item = $(object);
        if ($.trim(item.val().length) == 0) {
            $(".register_error_field").eq(index).text("Bạn không được để trống trường nào");
            flag = false;
        } else {
            $(".register_error_field").eq(index).text("");
        }
    });
    return flag;
}
function validateFullname() {
    // var name = $("#input_name");
    // if (checkLengh("name", "Họ tên")) {
    //     if (checkWordSpecil(name.val())) {
    //         $("#register_name_error").text("");
    //         $("#register_name_true").removeClass("register_validate");
    //         return true;
    //     } else {
    //         $("#register_name_error").text("Họ tên không được có kí tự đặc biệt");
    //         $("#register_name_true").addClass("register_validate");
    //         return false;
    //     }
    // }
    // else return false;
}
function validateMail() {
    var email = $("#input_email").val();
    // if(checkLengh("email","email")) {
    if ($.trim(email).length > 0) {
        if (!validateEmail(email)) {

            $("#register_email_error").text("Email nhập sai");
            $("#register_email_true").addClass("register_validate");
            return false;
        } else {
            $("#register_email_error").text("");
            $("#register_email_true").removeClass("register_validate");
            return true;
        }
        // }
    }
    else return false;
}
function validateRetypePassword() {
    var password = $("#input_password");
    var password2 = $("#input_password_2");
    if (($.trim(password.val()) != ($.trim(password2.val())))) {
        $("#register_password_error2").text("Nhập lại password chưa đúng");
        $("#register_password_true2").addClass("register_validate");
        return false;
    }
    else {
        $("#register_password_error2").text("");
        $("#register_password_true2").removeClass("register_validate");
        return true;
    }
}
function validateUsername() {
    var name = $("#input_username");
    if (checkLengh("username", "Tên đăng nhập")) {
        if (checkWordSpecil(name.val())) {
            $("#register_username_error").text("");
            $("#register_username_true").removeClass("register_validate");
            return true;
        } else {
            $("#register_username_error").text("Tên đăng nhập không được có kí tự đặc biệt");
            $("#register_username_true").addClass("register_validate");
            return false;
        }
    }
    else return false;
}
function validatePassword() {
    var name = $("#input_password");
    if (checkLengh("password", "Mật khẩu")) {
        if (checkWordSpecil(name.val())) {
            $("#register_password_error").text("");
            $("#register_password_true").removeClass("register_validate");
            return true;
        } else {
            $("#register_password_error").text("Mật khẩu không được có kí tự đặc biệt");
            $("#register_password_true").addClass("register_validate");
            return false;
        }
    }
    else return false;
}
function validateAddress() {
    // var name = $("#input_address");
    // if (checkLengh("address", "Địa chỉ")) {
    //     if (checkWordSpecil(name.val())) {
    //         $("#register_address_error").text("");
    //         $("#register_address_true").removeClass("register_validate");
    //         return true;
    //     } else {
    //         $("#register_password_error").text("Địa chỉ không được có kí tự đặc biệt");
    //         $("#register_password_true").addClass("register_validate");
    //         return false;
    //     }
    // }
    // else return false;
}

function validatePhoneNumber() {
    // var flagphone = true;
    var phone = $("#input_phone_number");
    var filter = new Array();
    filter[0] = /^09[0-8]{1}[0-9]{7}$/;
    filter[1] = /^016[3-9]{1}[0-9]{7}$/;
    filter[3] = /^012[0-9]{1}[0-9]{6}$/;
    filter[4] = /^099[3-6]{1}[0-9]{6}$/;
    filter[2] = /^01(88|99)[0-9]{6}$/;
    for (var i = 0; i <= 4; i++) {
        if (filter[i].test($.trim(phone.val()))) {
            $("#register_phone_error").text("");
            $("#register_phone_true").removeClass("register_validate");
            return true;

        }
    }
    {
        $("#register_phone_error").text("Số điện thoại nhập sai");
        $("#register_phone_true").addClass("register_validate");
        return false;
    }

}
function addDay(index) {
    var str = "<option value='" +
        index +
        "'>" +
        index +
        "</option>";
    return str;
}
function validateBirthday(day, month, year) {
    var d = new Date(year, month - 1, day);
    if (d && (d.getMonth()) + 1 == month) {
        $("#register_birthday_error").text("");
        return true;
    } else {
        $("#register_birthday_error").text("Bạn chọn sai ngày");
        return false;
    }

}
function getBirthday() {
    var day = $("#day").val();
    var month = $("#month").val();
    var year = $("#year").val();
    console.log(day);
    console.log(month);
    console.log(year);
    if (validateBirthday(day, month, year)) {

        if (parseInt(day) < 10)
            day = "0" + day;
        if (parseInt(month) < 10)
            month = "0" + month;
        console.log(day + "/" + month + "/" + year);
        return day + "/" + month + "/" + year;
    } else
        return "";
}
function checkEmptyAvatar() {
    if ($("#bt_choose_ava").val() == "") {
        $("#register_avatar_error").text("Bạn chưa chọn avatar");
        return false;
    }
    else {
        $("#register_avatar_error").text("");
        return true;
    }

}
function checkImage() {
    var width = $('#hidden_avatar').prop('naturalWidth');
    var height = $('#hidden_avatar').prop('naturalHeight');
}

function validateEmailLogin() {
    var email = $("#input_email_login").val();
    // if(checkLengh("email","email")){
    if ($.trim(email).length > 0) {
        if (!validateEmail(email)) {

            $("#login_email_error").text("Email nhập sai");
            $("#login_email_true").addClass("register_validate");
            return false;
        } else {
            $("#login_email_error").text("");
            $("#login_email_true").removeClass("register_validate");
            return true;
        }
    }
    else return false;
}
function validatePasswordLogin() {
    var pass = $("#input_password_login").val();
    if (pass.length < 8 || pass.length > 20) {
        $("#login_password_error").text("Mật khẩu từ 8 đến 20 kí tự");
        if (!$("#login_password_true").hasClass("register_validate"))
            $("#login_password_true").addClass("register_validate");
        return false;
    } else {
        if (!checkWordSpecil(pass)) {
            $("#login_password_error").text("Mật khẩu không được có kí tự đặc biệt");
            if (!$("#login_password_true").hasClass("register_validate"))
                $("#login_password_true").addClass("register_validate");
            return false;
        } else {
            $("#login_password_error").text("");
            $("#login_password_true").removeClass("register_validate");
            return true;
        }

    }
}
function validateLogin() {
    var flagLogin = true;
    if (!checkEmpty())
        flagLogin = false;
    // if(!validateEmailLogin())
    //     flagLogin = false;
    if (!validatePasswordLogin())
        flagLogin = false;
    return flagLogin;
}
// function submitLogin() {
//     $.ajax({
//         url: "/php/login.php",
//         type: "post",
//         dateType: "text",
//         data: {
//             use_password: $.trim($('#input_password_login').val()),
//             use_login: $.trim($('#input_email_login').val())
//         },
//         success: function (result) {
//             // $('#result').html(result);
//             alert(result);
//         }
//     });
// }
function submitLogin() {
    var email = $.trim($('#input_email_login').val());
    var password = $.trim($('#input_password_login').val());
    var use_isSave = $("#remember_password").prop("checked") ? 1 : 0;
    $.ajax({
        url: "/php/login.php",
        type: "post",
        dateType: "text",
        data: {
            use_password: password,
            use_login: email,
            use_isSave: use_isSave
        },
        success: function (result) {
            // $('#result').html(result);
            var res = JSON.parse(result);
            switch (res["code"]) {
                case 200:
                    var users = res["data"];
                    var role = parseInt(users["use_role"]);
                    usernameAdmin = users["use_username"];
                    fullnameAdmin = users["use_fullname"];
                    switch (role) {
                        case 0:
                            window.location = "/home";
                            break;
                        case 1:
                            window.location = "/admin";
                            break;
                        case 2:
                            window.location = "/admin";
                            break;
                    }
                    // window.location = "/home";
                    // $("#home_account").text(res["data"]["use_fullname"]);
                    // $("#home_login").css("display", "none");

                    break;
                case 201:
                    $("#login_error").text("Nhập sai dữ liệu");
                    break;
                case 202:
                    // $("#input_email_login").val(res["data"]["use_email"]);
                    $("#login_error").text("Email hoặc mật khẩu không đúng.");
                    break;
            }
        }
    });
}

function submitRegister() {
    var email = $.trim($('#input_email').val());
    var password = $.trim($('#input_password').val());
    var username = $.trim($('#input_username').val());
    var fullname = $('#input_name').val();
    var address = $('#input_address').val();
    var birthday = getBirthday();
    var gender = ($("#male").prop("checked")) ? 0 : 1;
    var description = $('#input_note').val();
    var phone = $("#input_phone_number").val();
    $.ajax({
        url: "/php/storeUser.php",
        type: "post",
        dateType: "text",
        data: {
            use_password: password,
            use_email: email,
            use_username: username,
            use_fullname: fullname,
            use_address: address,
            use_birthday: birthday,
            use_gender: gender,
            use_description: description,
            use_phone_number: phone,
            use_role: 0
        },
        success: function (result) {
            // $('#result').html(result);
            var res = JSON.parse(result);
            if (res["code"] == 200) {
                alert("Đăng kí thành công")
                window.location = "login.php";
                // $("#login_error").text("");
            } else
                $("#register_error").text(res["message"]);
        }
    });
}


// function getDataLogin() {
//     var isRemember = getCookie("remember");
//     alert(isRemember);
//     if (isRemember == "true") {
//         $("#input_email_login").val(getCookie("login"));
//         $("#input_password_login").val(getCookie("password"));
//         $("#remember_password").attr("checked", "checked");
//     }
//     else {
//         $("#input_email_login").val("");
//         // $("#input_password_login").val("");
//     }
// }

function addField(id, username, fullname, time_create, last_update, active, role) {
    var nameRole = "";
    // if (last_update == null)
    //     last_update = "Chưa chỉnh sửa";
    switch (parseInt(role)) {
        case 0:
            nameRole = "normal";
            break;
        case 1:
            nameRole = "admin";
            break;
        case 2:
            nameRole = "super_admin";
    }
    if (active == 1) {
        nameActive1 = "display_active";
        nameActive0 = "non_display_active"
    } else {
        nameActive0 = "display_active";
        nameActive1 = "non_display_active"
    }
    var str = '<div class="field"> ' +
        '<div class="use_field use_id"> ' +
        '<p class="field_name id_use">' +
        id +
        '</p> ' +
        '</div> ' +
        '<div  class="use_field use_username"> ' +
        '<p class="field_name">' +
        username +
        '</p> ' +
        '</div> ' +
        '<div  class="use_field use_fullname"> ' +
        '<p class="field_name">' +
        fullname +
        '</p> ' +
        '</div> ' +
        '<div  class="use_field use_time_create"> ' +
        '<p class="field_name">' +
        time_create +
        '</p>' +
        ' </div> ' +
        '<div  class="use_field use_last_update"> ' +
        '<p class="field_name">' +
        last_update +
        '</p>' +
        ' </div> ' +
        '<div class="use_field use_active"> ' +
        '<div class="bt_active"> ' +
        '<div class="active1 ' +
        nameActive1 +
        '"> ' +
        '<i class="fa fa-check " aria-hidden="true"></i> ' +
        '</div> ' +
        '<div class="active0 ' +
        nameActive0 +
        '"> ' +
        '<span class="">active</span> ' +
        '</div> ' +
        '</div> ' +
        '</div>' +
        '<div class="use_field use_role"> ' +
        '<p class="field_name' +
        ' ' +
        nameRole +
        '">' +
        nameRole +
        '</p> ' +
        '</div>' +
        '<div class="bt_change use_field boder_right"> ' +
        '<div>' +
        '<div class="center"> ' +
        '<div class="bt_edit"> ' +
        '<i class="fa fa-pencil" aria-hidden="true"></i> ' +
        '</div> ' +
        '<div class="bt_delete"> ' +
        '<i class="fa fa-times" aria-hidden="true"></i> ' +
        '</div> ' +
        '</div> ' +
        '</div>' +
        '</div>' +
        '</div>';
    $("#add").before(str);
}
function getAdminData() {
    $("#name_admin").text(usernameAdmin);
    $("#fullname_admin").val(fullnameAdmin);
}
function loadListUsers() {
    $.ajax({
        url: "/php/getAllUsers.php",
        type: "get",
        dateType: "text",
        data: {},
        success: function (result) {
            var temp = JSON.parse(result);
            if (temp["code"] == 200) {
                listAccount = temp["data"];
                // for (var i = 0; i < listAccount.length; i++) {
                //     var user = listAccount[i];
                //     var username = user["use_username"];
                //     var id = user["use_id"];
                //     var role = user["use_role"];
                //     var time_create = user["use_time_create"];
                //     var fullname = user["use_fullname"];
                //     var last_update = user["use_last_update"];
                //     var active = user["use_active"];
                //
                //     addField(id, username, fullname, time_create, last_update, active, role);
                // }
            }
        }
    });
}

// function getSeesion(name) {
//     $.ajax({
//         url: "/php/actionEdit.php",
//         type: "post",
//         dateType: "text",
//         data: {
//             name: name
//         },
//         success: function (result) {
//             abc = JSON.parse(result);
//             alert(abc["code"]);
//         }
//     });
//     alert(abc["code"]);
// }
function loadInfoUsername() {
    if (getCookie("idUser") > 0) {
        var id = getCookie("idUser");
        setCookie("idUser", id, -1);
        $.ajax({
            url: "/php/getInfoUsername.php",
            type: "post",
            dataType: "text",
            data: {
                use_id: id
            },
            success: function (result) {
                var res = JSON.parse(result);
                if (res["code"] == 200) {
                    var user = res["data"];
                    $("#input_name").val(user["use_fullname"]);
                    $("#role").val(user["use_role"]).attr("selected", true);
                    $("#input_email").val(user["use_email"]);
                    $("#input_username").val(user["use_username"]);
                    $("#input_address").val(user["use_address"]);
                    $("#input_phone_number").val(user["use_phone_number"]);
                    $("#input_note").val(user["use_description"]);
                    if (user["use_gender"] == 0) {
                        $("#male").attr("checked", "checked");
                        $("#female").removeAttr("checked");
                    }
                    else {
                        $("#female").attr("checked", "checked");
                        $("#male").removeAttr("checked");
                    }
                    $("#day").val(parseInt(user["day"]));
                    $("#month").val(parseInt(user["month"]));
                    $("#year").val(parseInt(user["year"]));
                    $("#input_avatar").css("display", "block");
                    $("#img_avatar").attr("src", "/uploads/" + user["use_avatar"]);
                    $("#bt_choose_ava").css("display", "none");
                    if (getCookie("admin_role") != 2)
                        $("#role").prop("disabled", true);

                }
            }
        })
    }
}

// function editUsername() {
//     $.ajax({
//         url: "/php/test.php",
//         type: "post",
//         dateType: "text",
//         enctype: 'multipart/form-data',
//         data: {
//             // use_username:
//         },
//         success: function (result) {
//             var temp = JSON.parse(result);
//             abc = temp["data"];
//         }
//     });
//     alert(abc);
// }
function validateEdit() {
    flagRegister = true;
    console.log("empty: " + checkEmpty());
    if (!checkEmpty()) {

        flagRegister = false;
    }
    if (!validatePhoneNumber())
        flagRegister = false;
    if (!validateBirthday($("#day").val(), $("#month").val(), $("#year").val()))
        flagRegister = false;

    if (flagRegister)
        $("#input_birthday").val(getBirthday());
    return flagRegister;
}

function validateFormAddCat() {
    var res = true;
    var list = $(".input_form");
    var err = $(".cat_err");
    list.each(function (index, object) {
        if ($.trim($(object).val()).length == 0) {
            res = false;
            err.eq(index).text("Bạn không được để trống trường nào");
        }
        else if ($.trim($(object).val()).length > 20) {
            res = false;
            err.eq(index).text("Nhập tối đa 20 kí tự");
        }
        else
            err.eq(index).text("");
    })
    return res;
}
function validateFormAddPro() {
    var res = true;
    var list = $(".input_form");
    var err = $(".pro_err");
    list.each(function (index, object) {
        if ($.trim($(object).val()).length == 0) {
            res = false;
            err.eq(index).text("Bạn không được để trống trường nào");
        }
        else if ($.trim($(object).val()).length > 20) {
            res = false;
            err.eq(index).text("Nhập tối đa 20 kí tự");
        }
        else
            err.eq(index).text("");
    });
    if ($("#choose_ava_pro").val() == "") {

        $("#choose_ava_pro_err").text("Bạn chưa chọn ảnh");
        res = false;
    }
    else
        $("#choose_ava_pro_err").text("");
    if (!validatePrice($("#pro_price").val())) {
        $("#pro_price_err").text("Bạn nhập giá chưa đúng");
        res = false;
    }
    else
        $("#pro_price_err").text("");

    return res;
}
function validatePrice(price) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var filter1 = /^([\d]+)?$/;
    var filter2 = /^([\d]+\.+[\d]+)?$/;
    return filter1.test($.trim(price)) || filter2.test($.trim(price));
}

function validateFormEditPro() {
    var res = true;
    var list = $(".input_form");
    var err = $(".pro_err");
    list.each(function (index, object) {
        if ($.trim($(object).val()).length == 0) {
            res = false;
            err.eq(index).text("Bạn không được để trống trường nào");
        }
        else if ($.trim($(object).val()).length > 20) {
            res = false;
            err.eq(index).text("Nhập tối đa 20 kí tự");
        }
        else
            err.eq(index).text("");
    });
    if (!validatePrice($("#pro_price").val())) {
        $("#pro_price_err").text("Bạn nhập giá chưa đúng");
        res = false;
    }
    else
        $("#pro_price_err").text("");

    return res;
}
function loadHeightContent() {
    // var heightContent = $("body").css("height");
    // // var heightContent = $(".wrapper").css("height");
    // $("#admin_left").css("height", heightContent);
    // $("#admin_right").css("height", heightContent);
    // $("#footer_admin").css("top", heightContent);
}

function loadAllProduct() {
    $.ajax({
        url: "/php/getAllProduct.php",
        type: "get",
        dataType: "text",
        data: {},
        success: function (result) {
            var res = JSON.parse(result);
            if (res["code"] == 200) {

                listProduct = res["data"];
                listTemp = listProduct;
            }
            else
                alert(res["message"]);

        }
    });
}
function loadProductHot() {
    $.ajax({
        url: "/php/getProductHot.php",
        type: "get",
        dataType: "text",
        data: {},
        success: function (result) {
            var res = JSON.parse(result);
            if (res["code"] == 200)
                listHot = res["data"];
            // else
            // alert(res["message"]);

        }
    });
}

function test() {
    alert(123)
}
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function getProductOfCat(catId) {
    $.ajax({
        url: "/php/getProductOfCat.php",
        type: "post",
        dataType: "text",
        data: {
            cat_id: catId
        },
        success: function (result) {
            var res = JSON.parse(result);
            if (res["code"] == 200) {
                alert(result)
                listProductOfCat = res["data"];
            }
            else
                alert(res["message"]);

        }
    });
}