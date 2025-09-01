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
    <link href="{{env('APP_URL')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/media/originales/logo_lignos_seguro.png" rel="icon"/>
        
    <!--begin::Fonts -->
    <style>
        @page { margin: 0px; }
        @font-face{
            font-family: 'Bogart';
            src: url("{{ public_path('fonts/Bogart-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face{
            font-family: 'Evolventa';
            src: url("{{ public_path('fonts/Evolventa-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face{
            font-family: 'Montserrat';
            src: url("{{ public_path('fonts/Montserrat-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face{
            font-family: 'RocaTwo';
            src: url("{{ public_path('fonts/Roca_Two_Bold.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        html { -webkit-print-color-adjust: exact; }
        body { 
            background-image: url("{{env('APP_URL')}}/assets/media/originales/fondo_presupuesto.png");
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0px;
            font-family: 'Bogart', 'Evolventa', 'Montserrat', 'RocaTwo';
            color: #836870;
        }

        .pagA4{
            height:297mm;
            width:210mm;
            margin-left: 7%; 
            padding: 20px;
        }

        /* colornrj1 #fdfbfa;
        colornrj2 #f6f1ef;
        colornrj1 #e3d5cc; */
        .rocaTwo {
            font-family: 'RocaTwo'!important;
        }
        .bogart {
            font-family: 'Bogart'!important;
        }
        .evolventa {
            font-family: 'Evolventa'!important;
        }
        .montserrat {
            font-family: 'Montserrat'!important;
        }
    </style>

</head>
<body>
    <div class="pagA4"> 
        <div style="margin-top: 30px; margin-left: 20px;"> 
            <h1 style="font-family: Arial, Helvetica, sans-serif">PRESUPUESTO</h1>
            <h3 class="evolventa"> {{date('d/m/Y',strtotime($budget->fecha))}} - Válido por {{ $budget->valid }} días</h3>
        </div>
    </div>
    <div class="pagA4">
        <p>Similique ullam nostrum perspiciatis. Aliquid eos tempore fugit dolor cum. Velit omnis tenetur non iste doloribus, numquam distinctio aperiam quaerat eos cum unde voluptatem harum mollitia optio accusantium eius rem!</p>
        <p>Possimus sit quos eos minus natus voluptatibus obcaecati enim officia dolore vitae, assumenda ab aperiam voluptatum quasi doloribus inventore autem itaque, et ipsum! Optio quia autem nesciunt perspiciatis non pariatur.</p>
        <p>Eligendi aliquid repellendus quae, atque mollitia doloribus fugiat non tempore nostrum, quod inventore tenetur architecto? Repudiandae nisi inventore neque architecto nostrum quasi fugiat, veniam eaque, id excepturi officia ullam quos.</p>
        <p>Harum beatae distinctio repellat pariatur facilis cum alias labore non nam adipisci iure magnam excepturi suscipit, voluptates illo laudantium nihil ad nisi nemo aliquam itaque ducimus, deserunt molestias? Laboriosam, neque.</p>
        <p>Provident non nostrum nemo incidunt nisi rerum maxime voluptates rem magni itaque consequuntur delectus cum unde odio, numquam voluptatibus ex ad magnam perferendis consequatur natus. Perspiciatis veritatis deleniti velit minus.</p>
        <p>Veniam ipsum incidunt porro quibusdam omnis laborum repellat impedit debitis, nobis eos explicabo aliquid nisi. Mollitia unde eveniet architecto ipsa porro dolor aliquid quae, provident nobis, sequi, dolorem sit? Perspiciatis.</p>
        <p>Doloribus praesentium architecto, saepe ab odit unde delectus illo nihil iusto, cum iste libero cumque dolores deserunt, eos nulla atque nam fuga laudantium impedit repudiandae! Distinctio iure modi ut voluptate!</p>
        <p>Soluta corrupti ratione doloremque aperiam vero fuga, est ipsum molestias atque ipsa. Officia corporis ab recusandae nemo quam. Repellat quibusdam quaerat aspernatur excepturi quos minus voluptate modi, earum a doloribus.</p>
        <p>Autem, adipisci porro. Esse voluptatibus sit alias. Cumque numquam ex magnam sequi voluptatibus ad eaque dolorum, itaque veritatis ab aut, eligendi minus molestias dolor! Dolor consectetur veritatis quas id mollitia?</p>
        <p style="font-family: 'RocaTwo';" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate sint ad minus vero consectetur, error molestiae nostrum qui? Saepe distinctio asperiores praesentium cupiditate, earum corporis in architecto ullam dolor dicta.</p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo eos possimus ipsam. Consectetur adipisci deserunt commodi rerum explicabo soluta eos ab suscipit, et ullam dolorem odit ipsa sed perspiciatis ratione.</p>
        <p>Similique ullam nostrum perspiciatis. Aliquid eos tempore fugit dolor cum. Velit omnis tenetur non iste doloribus, numquam distinctio aperiam quaerat eos cum unde voluptatem harum mollitia optio accusantium eius rem!</p>
        <p>Possimus sit quos eos minus natus voluptatibus obcaecati enim officia dolore vitae, assumenda ab aperiam voluptatum quasi doloribus inventore autem itaque, et ipsum! Optio quia autem nesciunt perspiciatis non pariatur.</p>
        <p>Eligendi aliquid repellendus quae, atque mollitia doloribus fugiat non tempore nostrum, quod inventore tenetur architecto? Repudiandae nisi inventore neque architecto nostrum quasi fugiat, veniam eaque, id excepturi officia ullam quos.</p>
        <p>Harum beatae distinctio repellat pariatur facilis cum alias labore non nam adipisci iure magnam excepturi suscipit, voluptates illo laudantium nihil ad nisi nemo aliquam itaque ducimus, deserunt molestias? Laboriosam, neque.</p>
        <p>Provident non nostrum nemo incidunt nisi rerum maxime voluptates rem magni itaque consequuntur delectus cum unde odio, numquam voluptatibus ex ad magnam perferendis consequatur natus. Perspiciatis veritatis deleniti velit minus.</p>
        <p>Veniam ipsum incidunt porro quibusdam omnis laborum repellat impedit debitis, nobis eos explicabo aliquid nisi. Mollitia unde eveniet architecto ipsa porro dolor aliquid quae, provident nobis, sequi, dolorem sit? Perspiciatis.</p>
        <p>Doloribus praesentium architecto, saepe ab odit unde delectus illo nihil iusto, cum iste libero cumque dolores deserunt, eos nulla atque nam fuga laudantium impedit repudiandae! Distinctio iure modi ut voluptate!</p>
    </div>
 
</body>
</html>