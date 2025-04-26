<div class="box setdepruebas">
  <h4 class="text-slate-500 text-2xl mb-4"><i class="fa-solid fa-building-circle-check mr-4"></i>Set de pruebas</h4>
  <?php include __DIR__. "/../../templates/alertas.php"; ?>

  <div class="">

    <form class="" action="/admin/factura/setdepruebas" method="POST">
      
      <div class="mx-auto max-w-xl">
        <div class="mb-5">
          <label for="idcompany" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Razon social</label>
          <select id="idcompany" name="idcompany" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
            <option value="" disabled selected>-Seleccionar-</option>
            <?php foreach($companies as $value): ?>
              <option value="<?php echo $value->id;?>"><?php echo $value->objuser->name.": ".$value->identification_number."-".$value->dv;?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-5 col-span-3">
          <label for="set" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Set de pruebas</label>
          <input type="text" id="set" name="set" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
        </div>

        <div class="mb-5 col-span-3 text-right">
          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-8 py-4 text-center ">Enviar</button>
        </div>
            
      </div>

    </form>
    
  </div>
</div>