<!DOCTYPE html>
<html>
<head>
    <title><?=$this->lang->line('report_certificate')?></title>
    <script type="text/javascript" src="<?php echo base_url('assets/inilabs/jquery.min.js'); ?>"></script>

    <link rel="SHORTCUT ICON" href="<?=base_url("uploads/images/$siteinfos->photo")?>" />
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Allerta+Stencil" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans+Extra+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Calibri" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css?family=Michroma" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Prosto+One" rel="stylesheet"> 
    <link href="<?=base_url('assets/bootstrap/bootstrap.min.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/inilabs/combined.css'); ?>" >

    <?php
        if(isset($headerassets)) {
            foreach ($headerassets as $assetstype => $headerasset) {
                if($assetstype == 'css') {
                  if(customCompute($headerasset)) {
                    foreach ($headerasset as $keycss => $css) {
                      echo '<link rel="stylesheet" href="'.base_url($css).'">'."\n";
                    }
                  }
                } elseif($assetstype == 'js') {
                  if(customCompute($headerasset)) {
                    foreach ($headerasset as $keyjs => $js) {
                      echo '<script type="text/javascript" src="'.base_url($js).'"></script>'."\n";
                    }
                  }
                }
            }
        }
    ?>

    <style type="text/css">

        @page {
            margin: 0.1cm;
            size: portrait;
            orientation: portrait;
            size: A4;
        }

        .mainTestimonial {
            position: relative;
        }

        .testimonialHead {
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, 80%);
            font-size: 18px;
            padding: 3px 5px;
        }

        .topHeadingMiddleImg {
            width: 50px;
            height: 50px;
            display: none;
        }

        .topHeadingLeft {
            font-family: 'Calibri', cursive;
            left: 0;
            position: absolute;
            top: 50%;
            
            font-size: 12pt; 
        }

        .topHeadingMiddle {
            font-family: 'Calibri', cursive;
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, 50%);
            font-size: 12pt; 
        }

        .topHeadingRight {
            font-family: 'Calibri', cursive;
            right: 0;
            position: absolute;
            top: 50%;
            font-size: 12pt; 
        }

        .mainMiddleTextCenter {
            text-align: center;
        }

        .mainMiddleText {
            font-family: 'Calibri', cursive;
            font-size: 20px;
            padding: 3px 5px;
            width: 100%;
            text-align: center;
         }

         .top_heading_title {
            display: none;
            text-align: center;
            font-family: 'Calibri', sans-serif;
            text-transform: uppercase;
         }

        .testimonial {
            min-height: 550px; 
            width: 210mm;
            height: 277mm; 
            padding: 40mm 10mm 10mm 10mm;
            margin-left: auto;
            margin-right: auto;
            background: url("<?='../../../../../uploads/images/'.$certificate_template->background_image?>") no-repeat !important;
            background-size: 100% 100% !important;
            -webkit-print-color-adjust: exact;
        }

        @media print {
            .testimonial {
                min-height: 550px;
                margin-left: auto;
                margin-right: auto; 
                 width: 210mm;
            height: 277mm; 
            padding: 40mm 10mm 10mm 10mm;
                margin-left: auto;
                margin-right: auto;
                background: url("<?='../../../../../uploads/images/'.$certificate_template->background_image?>") no-repeat !important;
                background-size: 100% 100% !important;
                -webkit-print-color-adjust: exact;
            }
        }

        .slno span {
            font-size: 16px;
            font-weight: 600;
        }

        .testimonialInfo {
            margin-top: 30px; 

        }

        body {
            font-family: 'Calibri', cursive;
            font-size: 12pt;
        }
        .testimonialContent {
            font-family: 'Calibri', cursive;
            font-size: 24px;
            letter-spacing: 1px;
            line-height: 25px;
            letter-spacing: 4px;
        }

       .testimonialContent .dots {
            display: inline-block;
            height: 20px;
            line-height: 10px;
            position: relative;
            font-weight: 600;
        }

      .testimonialContent .dots::after {
            border-bottom: 2px dotted #999;
            bottom: 0;
            content: "";
            height: 0;
            left: 0;
            position: absolute;
            width: 100%;
        }

        .testimonialContent .dots::before {
            content: attr(data-hover);
            font-style: italic;
            height: 5px;
            left: 0;
            position: absolute;
            text-align: center;
            top: 10px;
            width: 100%;
        }

        .testimonialContent .dots.widthcss{
            width: 20%;
        }

        .headSection {
            margin-top: 80px;
            display: none;
        }

        .footerSection {
            margin-top: 30px;
        }

        .footer_left_text {
            font-family: 'Calibri', cursive;
            font-size: 14px;

        }

        .footer_middle_text {
            font-family: 'Calibri', cursive;
            font-size: 14px;
            text-align: center;
        }

        .footer_right_text {
            font-family: 'Calibri', cursive;
            font-size: 14px;
            text-align: center;
        }

       .btn_border {
            border: 1px solid #ddd;
            padding: 6px;
            display: inline-block;
            border-radius: 10px;
            background: #E9E9E9
        }
        .row{margin-left: 0px;margin-right: 0px}
        .col-sm-12{padding-left: 0px;padding-right: 0px}

    </style>
</head>
<body>
     

    <div class="row">
        <div class="col-sm-12">

            <div id="printablediv">

                <div class="testimonial">
                    <div class="mainTestimonial">
                        <h2 class="top_heading_title"><?=$certificate_template->top_heading_title?></h2>

                       <div class="row">
                            <span class="topHeadingLeft"><?=$certificate_template->top_heading_left?></span> 

                            <span class="topHeadingMiddle"><img class="topHeadingMiddleImg" src="<?=base_url('uploads/images/'.$siteinfos->photo)?>"></span> 

                            <span class="topHeadingRight"><?=$certificate_template->top_heading_right?></span> 
                       </div>
                    </div>


                    <div class="headSection">
                        <div class="row" >
                            <div class="col-sm-12 mainMiddleTextCenter"><span class="mainMiddleText"><?=$certificate_template->main_middle_text?></span></div>
                        </div>
                    </div>

                    <div class="testimonialInfo">
                        <p class="testimonialContent">
                            <?=$certificate_template->template?>
                        </p>
                    </div>

                    <div class="footerSection">
                        <div class="row" >
                            <div style="padding: 0px;" class="col-sm-4 footer_left_text"><?=$certificate_template->footer_left_text?></div>
                            <div  style="padding: 0px;"  class="col-sm-4 footer_middle_text"></div>
                            <div  style="padding: 0px;"  class="col-sm-4 footer_right_text"><?=$certificate_template->footer_right_text?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     
</body>
</html>