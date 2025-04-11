(()=>{
    if(document.querySelector('.clientes')){
      
      //const miDialogoUpDireccion = document.querySelector('#miDialogoUpDireccion') as any;
      const selectdirecciones = document.querySelector('#selectdirecciones') as HTMLSelectElement;
      //const btnCerrarUpDireccion = document.querySelector('#btnCerrarUpDireccion') as HTMLButtonElement;
      let indiceFila=0, control=0, tablaClientes:HTMLElement;
      
      type direccionesapi = {
        id:string,
        idcliente:string,
        idtarifa:string,
        tarifa:{id:string, idcliente:string, nombre:string, valor:string},
        direccion:string,
        ciudad:string,
        departamento:string
      };
      let direcciones:direccionesapi[]=[];

  

      function upRemoveDir(e:Event){ //actualizar o eliminar direccion
        let idcliente = (e.target as HTMLElement).parentElement!.id, info = (tablaClientes as any).page.info();
        if((e.target as HTMLElement).tagName === 'I')idcliente = (e.target as HTMLElement).parentElement!.parentElement!.id;
        (async ()=>{
          try {
            const url = "/admin/api/direccionesXcliente?id="+idcliente; //llamado a la API REST y se trae las direcciones segun cliente elegido
            const respuesta = await fetch(url); 
            const resultado = await respuesta.json(); 
            direcciones = resultado;
            addDireccionSelect(resultado);
          } catch (error) {
              console.log(error);
          }
        })();
        miDialogoUpDireccion.showModal();
        document.addEventListener("click", cerrarDialogoExterno);
      }


       ////// añade direccion al select de direcciones al miDialogoUpDireccion, cuando se desea actualizar o eliminar la direccion de un cliente
      function addDireccionSelect<T extends {id:string, idcliente:string, idtarifa:string, tarifa:{id:string, idcliente:string, nombre:string, valor:string}, direccion:string, ciudad:string, departamento:string}>(addrs: T[]):void{
        while(selectdirecciones?.firstChild)selectdirecciones.removeChild(selectdirecciones?.firstChild);
        addrs.forEach(dir =>{
          const option = document.createElement('option');
          option.textContent = dir.direccion;
          option.value = dir.id;
          option.dataset.idcliente = dir.idcliente;
          option.dataset.idtarifa = dir.idtarifa;
          selectdirecciones.appendChild(option);
        });
        $('#uptarifa').val(addrs[0].idtarifa);
        (document.querySelector('#updepartamento') as HTMLInputElement).value = addrs[0].departamento;
        (document.querySelector('#upciudad') as HTMLInputElement).value = addrs[0].ciudad;
        (document.querySelector('#updireccion') as HTMLInputElement).value = addrs[0].direccion;
      }


      ///////// Evento al select de direcciones en el modal actualizar direciones de cada cliente ////////////
      selectdirecciones?.addEventListener('change', (e)=>{
        const select = (e.target as HTMLSelectElement);
        const idDir:string = select.options[select.selectedIndex].value;
        const objDireccion = direcciones.find(x=>x.id == idDir)!;
        $('#uptarifa').val(objDireccion?.idtarifa??1);
        (document.querySelector('#updepartamento') as HTMLInputElement).value = objDireccion.departamento;
        (document.querySelector('#upciudad') as HTMLInputElement).value = objDireccion.ciudad;
        (document.querySelector('#updireccion') as HTMLInputElement).value = objDireccion.direccion;
      });


      document.querySelector('#formUpDireccion')?.addEventListener('submit', e=>{
          e.preventDefault();
          // verificar si se oprimio el btn eliminar o actualizar del modal actualizar direccion
        });
        

      function eliminarClientes(e:Event){
        let idcliente = (e.target as HTMLElement).parentElement!.id, info = (tablaClientes as any).page.info();
        if((e.target as HTMLElement).tagName === 'I')idcliente = (e.target as HTMLElement).parentElement!.parentElement!.id;
        indiceFila = (tablaClientes as any).row((e.target as HTMLElement).closest('tr')).index();
        Swal.fire({
            customClass: {confirmButton: 'sweetbtnconfirm', cancelButton: 'sweetbtncancel'},
            icon: 'question',
            title: 'Desea eliminar el cliente?',
            text: "El cliente sera eliminado por completo.",
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
        }).then((result:any) => {
            if (result.isConfirmed) {
                (async ()=>{ 
                    const datos = new FormData();
                    datos.append('id', idcliente);
                    try {
                        const url = "/admin/api/eliminarCliente";
                        const respuesta = await fetch(url, {method: 'POST', body: datos}); 
                        const resultado = await respuesta.json();  
                        if(resultado.exito !== undefined){
                          (tablaClientes as any).row(indiceFila+info.start).remove().draw(); 
                          (tablaClientes as any).page(info.page).draw('page');
                          Swal.fire(resultado.exito[0], '', 'success') 
                        }else{
                            Swal.fire(resultado.error[0], '', 'error')
                        }
                    } catch (error) {
                        console.log(error);
                    }
                })();//cierre de async()
            }
        });
      }


      btnCerrarUpDireccion.addEventListener('click', ()=>miDialogoUpDireccion.close());
  
  
      function limpiarformdialog(){
        (document.querySelector('#formCrearUpdateCliente') as HTMLFormElement)?.reset();
      }
      function cerrarDialogoExterno(event:Event) {
        if (event.target === miDialogoCliente || event.target === miDialogoCrearDireccion || event.target === miDialogoUpDireccion || (event.target as HTMLInputElement).value === 'salir') {
          miDialogoCliente.close();
          miDialogoCrearDireccion.close();
          miDialogoUpDireccion.close();
          document.removeEventListener("click", cerrarDialogoExterno);
        }
      }
    }
  
  })();