<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="UTF-8">
    <title>Estudio Lignos Seguro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Estudio Lignos Seguro">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta http-equiv="Cache-control" content="no-cache">
    <link rel="stylesheet" href="{{$css}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400..700&family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Questrial&display=swap" rel="stylesheet">

    <link href="/assets/media/originales/logo_lignos_seguro.png" rel="icon"/>
      

    <style>

    </style>
    <!--begin::Fonts -->
    <style>
        /* colornrj1 #fdfbfa;
         * colornrj2 #f6f1ef;
         * colornrj1 #e3d5cc;

         * Domine -> bogart 
         * Evolventa -> Questrial
         * Montserrat
         * RocaTwo - Merriweather
        */
        @page {
          size: A4;  
          margin: 0; /* Asegura cero márgenes */
          padding: 0;
        }

        .montserrat-family {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            /* font-weight: <weight>; */
            font-style: normal;
        }
        
        .domine-family {
            font-family: "Domine", serif;
            font-optical-sizing: auto;
            /* font-weight: <weight>; */
            font-style: normal;
        }

        .questrial-regular {
            font-family: "Questrial", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        
        .merriweather-sans-family {
            font-family: "Merriweather Sans", sans-serif;
            font-optical-sizing: auto;
            /* font-weight: <weight>; */
            font-style: normal;
        }


        html { -webkit-print-color-adjust: exact; }

        body { 
          background: #E3D5CC;
          font-family: 'Merriweather Sans', 'Questrial', 'Montserrat', 'Domine', Arial, Helvetica, sans-serif;
          color: #836870!important;
          z-index: -1;
        }

        .headpdf{
            background-color: #f6f1ef !important;
            min-height: 20vh!important;
            max-height: 20vh!important;
            margin-left: 5%;
            margin-right: 0;
            padding: 0;
        }
        .bodypdf{
            background-color: #FDFBFA !important;
            min-height: 65vh!important;
            max-height: 65vh!important;
            margin-left: 5%;
            margin-right: 0;
            padding: 0;
        }

        .footpdf{
            background-color: #f6f1ef !important;
            min-height: 15vh!important;
            max-height: 15vh!important;
            margin-left: 5%;
            margin-right: 0;
            padding: 0;
        }

        th, td {
            border: 4px solid rgba(253, 251, 250, 1) !important;
            padding: 15px;
            border-collapse: separate;
        }

        .page-break {
            page-break-after: always;
        }
        .page-break:last-child {
            page-break-after: auto; /* Prevent an extra blank page at the end */
        }

    </style>

</head>
<body> 
    <div class="container-fluid">

        @for ($i = 1; $i < 4; $i++)
          <div class="row">
            @include('budget.pdf_body', ['page' => $i])
            @include('budget.pdf_head', ['page' => $i])
            
            @include('budget.pdf_footer')
          </div>
        @endfor
       
    </div>
    
    <script src="{{env('APP_URL')}}/assets/js/jquery/dist/jquery.js"></script>
    <script src="{{env('APP_URL')}}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>