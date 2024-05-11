const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const bcrypt = require('bcrypt');
const cors = require('cors');

const app = express();

app.use(function(req, res, next) {
    res.setHeader('Access-Control-Allow-Origin', '*');
    res.setHeader('Access-Control-Allow-Methods', '*');
    res.setHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
});

app.use(bodyParser.json());

const PUERTO = 3000;

const conexion = mysql.createConnection(
    {
        host: 'localhost',
        database: 'invensus_storage',
        user: 'root',
        password: ''
    }
);

app.listen(PUERTO, () => {
    console.log(`Servidor corriendo en el puerto ${PUERTO}`);
});

conexion.connect(error => {
    if (error) throw error;
    console.log('Conexión exitosa a la base de datos');
});

app.get('/', (req, res) => {
    res.send('API');
});

app.use(cors({
    origin: 'http://localhost:4200'
}));
 

app.get('/categorias', (req, res) => {
    const query = 'SELECT * FROM categorias;';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay categorias');
        }
    });
});

app.get('/categorias/:id', (req, res) => {
    const { id } = req.params;

    const query = `SELECT * FROM categorias WHERE idcategoria=${id};`;
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay categorias ');
        }
    });
});

app.post('/categorias/agregar', (req, res) => {
    const categorias = {
        cat_nombre: req.body.cat_nombre,
    };

    const query = 'INSERT INTO categorias SET ?';
    conexion.query(query, categorias, (error) => {
        if (error) return console.error(error.message);

        res.json('Se insertó correctamente la categoria');
    });
});

app.put('/categorias/actualizar/:id', (req, res) => {
    const { id } = req.params;
    const { cat_nombre } = req.body;

    const query = `UPDATE categorias SET cat_nombre='${cat_nombre}' WHERE idcategoria='${id}';`;
    conexion.query(query, (error) => {
        if (error) return console.error(error.message);

        res.json('Se actualizó correctamente la categoria');
    });
});

app.delete('/categorias/borrar/:id', (req, res) => {
    const { id } = req.params;

    const query = `DELETE FROM categorias WHERE idcategoria=${id};`;
    conexion.query(query, (error) => {
        if (error) console.error(error.message);

        res.json('Se eliminó correctamente la categorias');
    });
});

app.get('/usuarios', (req, res) => {
    const query = 'SELECT * FROM usuarios;';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay usuarios');
        }
    });
});

app.post('/usuarios/agregar', async (req, res) => {
    const usuarios = {
        usu_nombre: req.body.usu_nombre,
        usu_tipoid: req.body.usu_tipoid,
        usu_identificacion: req.body.usu_identificacion,
        usu_numerotel: req.body.usu_numerotel,
        usu_correo: req.body.usu_correo,
        usu_estado: req.body.usu_estado,
        idgenero: req.body.idgenero,
        idroles: req.body.idroles
    };

   
    try {
        const hashedPassword = await bcrypt.hash(req.body.usu_contrasena, saltRounds);
        usuarios.usu_contrasena = hashedPassword;

        const query = 'INSERT INTO usuarios SET ?';
        conexion.query(query, usuarios, (error) => {
            if (error) return console.error(error.message);

            res.json('Se insertó correctamente el usuario');
        });
    } catch (error) {
        console.error(error.message);
        res.status(500).json('Error al encriptar la contraseña');
    }
});

app.get('/usuarios/activos', (req, res) => {
    const query = '  SELECT * FROM usuarios WHERE usu_estado = \'activo\';';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay usuarios activos');
        }
    });
});

app.get('/usuarios/inactivos', (req, res) => {
    const query =` SELECT * FROM usuarios WHERE usu_estado = 'inactivo' OR usu_estado IS NULL;`;
    conexion.query(query, (error, resultado) => {
        if (error) {
            console.error(error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay usuarios inactivos');
        }
    });
});

app.get('/usuarios/:id', (req, res) => {
    const { id } = req.params;

    const query = ` SELECT * FROM usuarios WHERE idusuarios=${id};`;
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay usuarios');
        }
    });
});

const saltRounds = 10;

app.put('/usuarios/actualizar/:id', (req, res) => {
    const { id } = req.params;
    const { usu_nombre } = req.body;
    const { usu_tipoid } = req.body;
    const { usu_identificacion } = req.body;
    const { usu_numerotel } = req.body;
    const { usu_correo } = req.body;
    const { usu_contrasena } = req.body;
    const { usu_estado } = req.body;
    const { idgenero } = req.body;
    const { idroles } = req.body;

    const query = `UPDATE usuarios SET usu_nombre='${usu_nombre}', usu_tipoid='${usu_tipoid}', usu_identificacion='${usu_identificacion}', usu_numerotel='${usu_numerotel}', usu_correo='${usu_correo}', usu_contrasena='${usu_contrasena}', usu_estado='${usu_estado}', idgenero='${idgenero}', idroles='${idroles}' WHERE idusuarios='${id}';`;
    conexion.query(query, (error) => {
        if (error) return console.error(error.message);

        res.json('Se actualizó correctamente el usuario');
    });
});

app.delete('/usuarios/borrar/:id', (req, res) => {
    const { id } = req.params;

    const query = `DELETE FROM usuarios WHERE idusuarios=${id};`;
    conexion.query(query, (error) => {
        if (error) console.error(error.message);

        res.json('Se eliminó correctamente el usuario');
    });
});

app.get('/productos', (req, res) => {
    const query = 'SELECT * FROM productos;';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay registros');
        }
    });
});

app.get('/productos/:id', (req, res) => {
    const { id } = req.params;

    const query = `SELECT * FROM productos WHERE idproducto = ? LIMIT 1`;
    conexion.query(query, [id], (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado[0]); // Devuelve el primer elemento del arreglo (un solo objeto)
        } else {
            res.json('No hay registros');
        }
    });
});

app.post('/productos/agregar', (req, res) => {
    const producto = {
        prod_nombre: req.body.prod_nombre,
        prod_descripcion: req.body.prod_descripcion,
        prod_valor: req.body.prod_valor,
        prod_vencimiento: req.body.prod_vencimiento,
        prod_alerta: req.body.prod_alerta,
        idcategoria: req.body.idcategoria,
        idproveedores: req.body.idproveedores
    };

    const query = 'INSERT INTO productos SET ?';
    conexion.query(query, producto, (error) => {
        if (error) return console.error(error.message);

        res.json('Se insertó correctamente el producto');
    });
});

app.put('/productos/actualizar/:id', (req, res) => {
    const { id } = req.params;
    const { prod_nombre, prod_descripcion, prod_valor, prod_vencimiento, prod_alerta, idcategoria, idproveedores } = req.body;

    const query = `UPDATE productos SET prod_nombre='${prod_nombre}', prod_descripcion='${prod_descripcion}', prod_valor='${prod_valor}', prod_vencimiento='${prod_vencimiento}', prod_alerta='${prod_alerta}', idcategoria='${idcategoria}', idproveedores='${idproveedores}' WHERE idproducto='${id}';`;
    conexion.query(query, (error) => {
        if (error) return console.error(error.message);

        res.json('Se actualizó correctamente el producto');
    });
});

app.delete('/productos/borrar/:id', (req, res) => {
    const { id } = req.params;

    const query = `DELETE FROM productos WHERE idproducto=${id};`;
    conexion.query(query, (error) => {
        if (error) console.error(error.message);

        res.json('Se eliminó correctamente el producto');
    });
});

app.get('/subcategorias', (req, res) => {
    const query = 'SELECT * FROM subcategorias;';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay registros');
        }
    });
});

app.get('/subcategorias/:id', (req, res) => {
    const { id } = req.params;

    const query = `SELECT * FROM subcategorias WHERE idsubcategorias=${id};`;
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay registros');
        }
    });
});

app.post('/subcategorias/agregar', (req, res) => {
    const subcategoria = {
        subc_nombre: req.body.subc_nombre,
        idcategoria: req.body.idcategoria
    };

    const query = 'INSERT INTO subcategorias SET ?';
    conexion.query(query, subcategoria, (error) => {
        if (error) return console.error(error.message);

        res.json('Se insertó correctamente la subcategoría');
    });
});

app.put('/subcategorias/actualizar/:id', (req, res) => {
    const { id } = req.params;
    const { subc_nombre, idcategoria } = req.body;

    const query = `UPDATE subcategorias SET subc_nombre='${subc_nombre}', idcategoria='${idcategoria}' WHERE idsubcategorias='${id}';`;
    conexion.query(query, (error) => {
        if (error) return console.error(error.message);

        res.json('Se actualizó correctamente la subcategoría');
    });
});

app.delete('/subcategorias/borrar/:id', (req, res) => {
    const { id } = req.params;

    const query = `DELETE FROM subcategorias WHERE idsubcategorias=${id};`;
    conexion.query(query, (error) => {
        if (error) console.error(error.message);

        res.json('Se eliminó correctamente la subcategoría');
    });
});

app.get('/paltos', (req, res) => {
    const query = 'SELECT * FROM platos;';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay platos');
        }
    });
});

app.get('/platos/activos', (req, res) => {
    const query = ' SELECT * FROM platos WHERE estado = \'activo\';';
    conexion.query(query, (error, resultado) => {
        if (error) {
            console.error(error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay platos activos');
        }
    });
});

app.get('/platos/inactivos', (req, res) => {
    const query = ' SELECT * FROM platos WHERE estado = \'inactivo\';';
    conexion.query(query, (error, resultado) => {
        if (error) {
            console.error(error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay platos inactivos');
        }
    });
});


app.get('/platos/:id', (req, res) => {
    const { id } = req.params;

    const query = ` SELECT * FROM platos WHERE idplatos=${id};`;
    conexion.query(query, (error, resultado) => {
        if (error) {
            console.error(error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay platos con el ID especificado');
        }
    });
});

app.post('/platos/agregar', (req, res) => {
    const platos = {
        pla_nombre: req.body.pla_nombre,
        pla_descripcion: req.body.pla_descripcion,
        pla_precio: req.body.pla_precio,
        pla_tiempopre: req.body.pla_tiempopre,
        idproducto: req.body.idproducto,
        estado: req.body.estado,
    };

    const query = 'INSERT INTO platos SET ?';
    conexion.query(query, platos, (error) => {
        if (error) return console.error(error.message);

        res.json('Se insertó correctamente el plato');
    });
});

app.post('/venta-platos', (req, res) =>{
    const venta = {
        pla_ventas: req.body.pla_ventas
    }

    const query = "INSERT INTO platos (pla_ventas) SET ?"
    conexion.query(query, venta, (error)=>{
        if (error) return console.error(error.message);

        res.json('Se vendio correctamente');
    })
});

app.put('/platos/actualizar/:id', (req, res) => {
    const { id } = req.params;
    const { pla_nombre, pla_descripcion, pla_precio, pla_tiempopre, idproducto, estado } = req.body;

    const query = `UPDATE platos SET pla_nombre=?, pla_descripcion=?, pla_precio=?, pla_tiempopre=?, idproducto=?, estado=? WHERE idplatos=?`;
    conexion.query(query, [pla_nombre, pla_descripcion, pla_precio, pla_tiempopre, idproducto, estado, id], (error) => {
        if (error) return console.error(error.message);

        res.json('Se actualizó correctamente el plato');
    });
});

app.delete('/platos/borrar/:id', (req, res) => {
    const { id } = req.params;

    const query = `DELETE FROM platos WHERE idplatos=${id};`;
    conexion.query(query, (error) => {
        if (error) console.error(error.message);

        res.json('Se eliminó correctamente el plato');
    });
});

app.get('/inventario', (req, res) => {
    const query = 'SELECT * FROM inventario_local1;';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay registros');
        }
    });
});

app.get('/inventario/:id', (req, res) => {
    const { id } = req.params;

    const query = `SELECT * FROM inventario_local1 WHERE idinventario_local1=${id};`;
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay registros');
        }
    });
});

app.post('/inventario/agregar', (req, res) => {
    const inventario = {
        invl_entradas: req.body.invl_entradas,
        invl_salidas: req.body.invl_salidas,
        invl_saldos: req.body.invl_saldos,
        idmovimiento_inventario: req.body.idmovimiento_inventario
    };

    const query = 'INSERT INTO inventario_local1 SET ?';
    conexion.query(query, inventario, (error) => {
        if (error) return console.error(error.message);

        res.json('Se insertó correctamente el inventario');
    });
});

app.put('/inventario/actualizar/:id', (req, res) => {
    const { id } = req.params;
    const { invl_entradas, invl_salidas, invl_saldos, idmovimiento_inventario} = req.body;
   

    const query = `UPDATE inventario_local1 SET invl_entradas='${invl_entradas}', invl_salidas='${invl_salidas}', invl_saldos='${invl_saldos}', idmovimiento_inventario='${idmovimiento_inventario}' WHERE idinventario_local1='${id}';`;
    conexion.query(query, (error) => {
        if (error) return console.error(error.message);

        res.json('Se actualizó correctamente el inventario');
    });
});

app.delete('/inventario/borrar/:id', (req, res) => {
    const { id } = req.params;

    const query = `DELETE FROM inventario_local1 WHERE idinventario_local1=${id};`;
    conexion.query(query, (error) => {
        if (error) console.error(error.message);

        res.json('Se eliminó correctamente el inventario');
    });
});

app.get('/proveedores', (req, res) => {
    const query = 'SELECT * FROM proveedores;';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay proveedores');
        }
    });
});

app.get('/proveedores/activos', (req, res) => {
    const query = ' SELECT * FROM proveedores WHERE pro_estado = \'activo\';';
    conexion.query(query, (error, resultado) => {
        if (error) {
            console.error(error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay proveedores activos');
        }
    });
});

app.get('/proveedores/inactivos', (req, res) => {
    const query = ' SELECT * FROM proveedores WHERE pro_estado = \'inactivo\';';
    conexion.query(query, (error, resultado) => {
        if (error) {
            console.error(error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay proveedores inactivos');
        }
    });
});

app.get('/proveedores/:id', (req, res) => {
    const { id } = req.params;

    const query = ` SELECT * FROM proveedores WHERE idproveedores=${id};`;
    conexion.query(query, (error, resultado) => {
        if (error) {
            console.error(error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay proveedores con el ID especificado');
        }
    });
});

app.post('/proveedores/agregar', (req, res) => {
    const proveedores = {
        pro_nombre: req.body.pro_nombre,
        pro_direccion: req.body.pro_direccion,
        pro_mail: req.body.pro_mail,
        pro_telefono: req.body.pro_telefono,
        pro_estado: req.body.pro_estado
    };

    const query = 'INSERT INTO proveedores SET ?';
    conexion.query(query, proveedores, (error) => {
        if (error) return console.error(error.message);

        res.json('Se insertó correctamente el proveedores');
    });
});

app.put('/proveedores/actualizar/:id', (req, res) => {
    const { id } = req.params;
    const { pro_nombre, pro_direccion, pro_mail, pro_telefono, pro_estado } = req.body;

    const query = `UPDATE proveedores SET pro_nombre='${pro_nombre}', pro_direccion='${pro_direccion}', pro_mail='${pro_mail}', pro_telefono='${pro_telefono}', pro_estado='${pro_estado}' WHERE idproveedores='${id}';`;
    conexion.query(query, (error) => {
        if (error) return console.error(error.message);

        res.json('Se actualizó correctamente la proveedores');
    });
});

app.delete('/proveedores/borrar/:id', (req, res) => {
    const { id } = req.params;

    const query = `DELETE FROM proveedores WHERE idproveedores=${id};`;
    conexion.query(query, (error) => {
        if (error) console.error(error.message);

        res.json('Se eliminó correctamente la proveedores');
    });
});

app.get('/proveedores/exists/:nombre', (req, res) => {
    const { nombre } = req.params;
 
    const query = 'SELECT COUNT(*) AS count FROM proveedores WHERE pro_nombre = ?';
    conexion.query(query, [nombre], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
 
      const count = resultado[0].count;
      res.json(count > 0); // Devuelve true si el nombre existe, false si no existe
    });
  });
  app.get('/proveedores/exists/direccion/:direccion', (req, res) => {
    const { direccion } = req.params;
 
    const query = 'SELECT COUNT(*) AS count FROM proveedores WHERE pro_direccion = ?';
    conexion.query(query, [direccion], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
 
      const count = resultado[0].count;
      res.json(count > 0); // Devuelve true si la dirección existe, false si no existe
    });
  });
// Verificar existencia de correo
app.get('/proveedores/exists/correo/:correo', (req, res) => {
    const { correo } = req.params;
 
    const query = 'SELECT COUNT(*) AS count FROM proveedores WHERE pro_mail = ?';
    conexion.query(query, [correo], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
 
      const count = resultado[0].count;
      res.json(count > 0); // Devuelve true si el correo existe, false si no existe
    });
  });
 
  // Verificar existencia de teléfono
  app.get('/proveedores/exists/telefono/:telefono', (req, res) => {
    const { telefono } = req.params;
 
    const query = 'SELECT COUNT(*) AS count FROM proveedores WHERE pro_telefono = ?';
    conexion.query(query, [telefono], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
 
      const count = resultado[0].count;
      res.json(count > 0); // Devuelve true si el teléfono existe, false si no existe
    });
  });
   


//MOSTRAR TODOS LOS REGISTROS DEL INVENTARIO DE LAS 3 SUCURSALES
app.get('/sucursal1', (req, res)=>{
    const query = 'SELECT sucursal1.*, productos.prod_nombre FROM sucursal1 INNER JOIN productos ON sucursal1.idproducto = productos.idproducto;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if (resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay inventario en sucursal 1')
        }
    });
});

app.get('/sucursal2', (req, res)=>{
    const query = 'SELECT sucursal2.*, productos.prod_nombre FROM sucursal2 INNER JOIN productos ON sucursal2.idproducto = productos.idproducto;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if (resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay inventario en sucursal 2')
        }
    });
});

app.get('/sucursal3', (req, res)=>{
    const query = 'SELECT sucursal3.*, productos.prod_nombre FROM sucursal3 INNER JOIN productos ON sucursal3.idproducto = productos.idproducto;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if (resultado.length>0){
            res.json(resultado);
        }else {
            res.json('No hay inventario en sucursal 3')
        }
    });
});

//SELECCIONA LAS LLEGADAS DE TODAS LAS SUCURSALES
app.get('/llegadas-sucursal1', (req, res)=>{
    const query = 'SELECT * FROM llegadas_sucursal1;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if (resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay inventario en sucursal 1')
        }
    });
});

app.get('/llegadas-sucursal2', (req, res)=>{
    const query = 'SELECT * FROM llegadas_sucursal2;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if (resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay inventario en sucursal 1')
        }
    });
});

app.get('/llegadas-sucursal3', (req, res)=>{
    const query = 'SELECT * FROM llegadas_sucursal3;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if (resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay inventario en sucursal 1')
        }
    });
});

//SELECCIONA LOS PRODUCTOS QUE HAY EL CADA SUCURSAL
app.get('/llegadas-sucursal1-productos', (req, res)=>{
    const query = 'select sucursal1.idproducto, productos.prod_nombre, sucursal1.cantidad_producto FROM sucursal1 JOIN productos ON sucursal1.idproducto = productos.idproducto;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if (resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay inventario en sucursal 1')
        }
    });
});

app.get('/llegadas-sucursal2-productos', (req, res)=>{
    const query = 'select sucursal2.idproducto, productos.prod_nombre, sucursal2.cantidad_producto FROM sucursal2 JOIN productos ON sucursal2.idproducto = productos.idproducto;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if (resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay inventario en sucursal 1')
        }
    });
});

app.get('/llegadas-sucursal3-productos', (req, res)=>{
    const query = 'select sucursal3.idproducto, productos.prod_nombre, sucursal3.cantidad_producto FROM sucursal3 JOIN productos ON sucursal3.idproducto = productos.idproducto;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if (resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay inventario en sucursal 1')
        }
    });
});


//SELECCIONA LOS PRODUCTOS QUE NO ESTAN REGISTRADOS EN LAS SUCURSALES
app.get('/sucursal1noregistrado', (req, res)=>{
    const query = 'SELECT productos.idproducto, productos.prod_nombre FROM productos LEFT JOIN sucursal1 ON productos.idproducto = sucursal1.idproducto WHERE sucursal1.idproducto IS NULL;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if(resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay productos')
        }
    });
});

app.get('/sucursal2noregistrado', (req, res)=>{
    const query = 'SELECT productos.idproducto, productos.prod_nombre FROM productos LEFT JOIN sucursal2 ON productos.idproducto = sucursal2.idproducto WHERE sucursal2.idproducto IS NULL;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if(resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay productos')
        }
    });
});

app.get('/sucursal3noregistrado', (req, res)=>{
    const query = 'SELECT productos.idproducto, productos.prod_nombre FROM productos LEFT JOIN sucursal3 ON productos.idproducto = sucursal3.idproducto WHERE sucursal3.idproducto IS NULL;';
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if(resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay productos')
        }
    });
});

//TRAE LAS CANTIDADES DE LOS PRODUCTOS
app.get('/sucursal1cantidad/:id', (req, res) =>{
    const {id} = req.params;
    const query = `SELECT cantidad_producto FROM sucursal1 WHERE idproducto=${id}`;
    conexion.query(query, (error, resultado)=>{
        if (error) return console.error(error.message);

        if(resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay cantidades');
        }
    });
});


//BUSCA LOS REGISTROS SEGUN LA FECHA DE INGRESO
app.get('/sucursal1fecha/:fecha', (req, res) => {
    const { fecha } = req.params;
    const query = `SELECT * FROM sucursal1 WHERE DATE(fecha_ingreso) = '${fecha}'`;
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No se encontraron registros para la fecha proporcionada');
        }
    });
});

app.get('/sucursal2fecha/:fecha', (req, res) => {
    const { fecha } = req.params;
    const query = `SELECT * FROM sucursal2 WHERE DATE(fecha_ingreso) = '${fecha}'`;
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No se encontraron registros para la fecha proporcionada');
        }
    });
});

app.get('/sucursal3fecha/:fecha', (req, res) => {
    const { fecha } = req.params;
    const query = `SELECT * FROM sucursal3 WHERE DATE(fecha_ingreso) = '${fecha}'`;
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No se encontraron registros para la fecha proporcionada');
        }
    });
});

app.get('/sucursalessuma', (req, res) => {
    const query = `SELECT idproducto, SUM(cantidad_producto) AS cantidad_total FROM ( SELECT idproducto, cantidad_producto FROM sucursal1 UNION ALL SELECT idproducto, cantidad_producto FROM sucursal2 UNION ALL SELECT idproducto, cantidad_producto FROM sucursal3 ) AS total_por_producto GROUP BY idproducto;`;
    conexion.query(query, (error, resultado) => {
        if (error) console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No se encontraron cantidades');
        }
    });
});

app.get('/total-valor', (req, res)=>{
    const query = `SELECT tp.idproducto, SUM(tp.cantidad_producto) AS cantidad_total, SUM(tp.cantidad_producto * p.prod_valor) AS cantidad_multiplicada FROM ( SELECT idproducto, cantidad_producto FROM sucursal1 UNION ALL SELECT idproducto, cantidad_producto FROM sucursal2 UNION ALL SELECT idproducto, cantidad_producto FROM sucursal3 ) AS tp INNER JOIN productos p ON tp.idproducto = p.idproducto GROUP BY tp.idproducto;`;
    conexion.query(query,(error, resultado)=>{
        if (error) console.error(error.message);

        if(resultado.length>0) {
            res.json(resultado);
        } else {
            res.json('No se encontraron valores');
        }
    });
});


//MOSTRAR REGISTRO POR ID DE LAS SUCURSALES
app.get('/sucursal1/:id', (req, res) =>{
    const {id} = req.params;

    const query = `SELECT * FROM sucursal1 WHERE idsucursal=${id};`;
    conexion.query(query, (error,resultado)=>{
        if (error) return console.error(error.message);

        if(resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay registros con el id insertado')
        }
    });
});

app.get('/sucursal2/:id', (req, res)=>{
    const {id} = req.params;

    const query = `SELECT * FROM sucursal2 WHERE idsucursal=${id}`;
    conexion.query(query, (error,resultado)=>{
        if (error) return console.error(error.message);

        if(resultado.length>0){
            res.json(resultado);
        } else {
            res.json('No hay resgistros con el id insertado')
        }
    });
});

app.get('/sucursal3/:id', (req, res)=>{
    const {id} = req.params;

    const query = `SELECT * FROM sucursal3 WHERE idsucursal=${id}`;
    conexion.query(query, (error,resultado)=>{
        if(error) return console.error(error.message);

        if(resultado.length>0){
            res.json(resultado);
        }else{
            res.json('No hay registros con el id insertado')
        }
    });
});

//AGREGAR REGISTROS A LAS TABLAS DE SUCURSALES
app.post('/sucursal1/agregar', (req, res) => {
    const sucursal1 = {
        idproducto: req.body.idproducto,
        cantidad_producto: req.body.cantidad_producto,
        fecha_ingreso: req.body.fecha_ingreso
    };

    const query = 'INSERT INTO sucursal1 SET ?';
    conexion.query(query, sucursal1, (error) => {
        if (error) return console.error(error.message);

        res.json('Se insertó correctamente');
    });
});

app.post('/llegadas-sucursal1/agregar', (req, res) => {
    const sucursal1 = {
        idproducto: req.body.idproducto,
        cantidad_llegada: req.body.cantidad_llegada,
        fecha_ingreso: req.body.fecha_ingreso
    };

    const query = 'INSERT INTO llegadas_sucursal1 SET ?';
    conexion.query(query, sucursal1, (error) => {
        if (error) return console.error(error.message);

        res.json('Se insertó correctamente');
    });
});

app.post('/llegadas-sucursal2/agregar', (req, res) => {
    const sucursal1 = {
        idproducto: req.body.idproducto,
        cantidad_llegada: req.body.cantidad_llegada,
        fecha_ingreso: req.body.fecha_ingreso
    };

    const query = 'INSERT INTO llegadas_sucursal2 SET ?';
    conexion.query(query, sucursal1, (error) => {
        if (error) return console.error(error.message);

        res.json('Se insertó correctamente');
    });
});

app.post('/llegadas-sucursal3/agregar', (req, res) => {
    const sucursal1 = {
        idproducto: req.body.idproducto,
        cantidad_llegada: req.body.cantidad_llegada,
        fecha_ingreso: req.body.fecha_ingreso
    };

    const query = 'INSERT INTO llegadas_sucursal3 SET ?';
    conexion.query(query, sucursal1, (error) => {
        if (error) return console.error(error.message);

        res.json('Se insertó correctamente');
    });
});

app.post('/sucursal2/agregar', (req, res)=>{
    const sucursal2 = {
        idproducto: req.body.idproducto,
        cantidad_producto: req.body.cantidad_producto,
        fecha_ingreso: req.body.fecha_ingreso
    }

    const query = 'INSERT INTO sucursal2 SET ?';
    conexion.query(query, sucursal2, (error)=>{
        if (error) return console.error(error.message);

        res.json('Se inserto correctamente');
    });
});

app.post('/sucursal3/agregar', (req, res)=>{
    const sucursal3={
        idproducto: req.body.idproducto,
        cantidad_producto: req.body.cantidad_producto,
        fecha_ingreso: req.body.fecha_ingreso
    }

    const query = 'INSERT INTO sucursal3 SET ?';
    conexion.query(query, sucursal3, (error)=>{
        if (error) return console.error(error.message);

        res.json('Se inserto correctamente');
    });
});

//ACTUALIZAR DATOS DE INVENTARIO DE LAS SUCURSALES
app.put('/sucursal1/actualizar/:idsucursal', (req, res)=>{
    const {idsucursal} = req.params;
    const {idproducto, cantidad_producto} = req.body;

    const query = `UPDATE sucursal1 SET idproducto='${idproducto}', cantidad_producto='${cantidad_producto}' WHERE idsucursal='${idsucursal}';`;
    conexion.query(query, (error)=>{
        if(error) return console.error(error.message);

        res.json('Se actualizo correctamente');
    });
});

app.put('/sucursal2/actualizar/:idsucursal', (req, res)=>{
    const {idsucursal} = req.params;
    const {idproducto, cantidad_producto} = req.body;

    const query = `UPDATE sucursal2 SET idproducto='${idproducto}', cantidad_producto='${cantidad_producto}' WHERE idsucursal='${idsucursal}';`;
    conexion.query(query, (error)=>{
        if (error) return console.error(error.message);

        res.json('Se actualizo correctamente');
    });
});

app.put('/sucursal3/actualizar/:idsucursal', (req, res)=>{
    const {idsucursal} = req.params;
    const {idproducto, cantidad_producto} = req.body;

    const query = `UPDATE sucursal3 SET idproducto='${idproducto}', cantidad_producto='${cantidad_producto}' WHERE idsucursal='${idsucursal}';`;
    conexion.query(query, (error)=>{
        if (error) return console.error(error.message);

        res.json('Se actualizo correctamente');
    });
});

app.put('/actualizar-cantidad-sucursal1', (req, res) => {
    const idproducto = req.body.idproducto;
    const nuevaCantidad = req.body.nuevaCantidad;

    const query = `UPDATE sucursal1 SET cantidad_producto = cantidad_producto + ${nuevaCantidad} WHERE idproducto = '${idproducto}'`;

    conexion.query(query, (error)=>{
        if (error) return console.log(error.message);

        res.json('Se actualizo la cantidad');
    });
});

app.put('/actualizar-cantidad-sucursal2', (req, res) => {
    const idproducto = req.body.idproducto;
    const nuevaCantidad = req.body.nuevaCantidad;

    const query = `UPDATE sucursal2 SET cantidad_producto = cantidad_producto + ${nuevaCantidad} WHERE idproducto = '${idproducto}'`;

    conexion.query(query, (error)=>{
        if (error) return console.log(error.message);

        res.json('Se actualizo la cantidad');
    });
});

app.put('/actualizar-cantidad-sucursal3', (req, res) => {
    const idproducto = req.body.idproducto;
    const nuevaCantidad = req.body.nuevaCantidad;

    const query = `UPDATE sucursal3 SET cantidad_producto = cantidad_producto + ${nuevaCantidad} WHERE idproducto = '${idproducto}'`;

    conexion.query(query, (error)=>{
        if (error) return console.log(error.message);

        res.json('Se actualizo la cantidad');
    });
});

//ELIMINAR REGISTROS DE INVENTARIO SUCURSALES
app.delete('/sucursal1/borrar/:idsucursal', (req, res)=>{
    const{idsucursal} = req.params;

    const query = `DELETE FROM sucursal1 WHERE idsucursal='${idsucursal}';`;
    conexion.query(query, (error)=>{
        if (error) return console.error(error.message);

        res.json('Se elimino correctamente');
    });
});

app.delete('/sucursal2/borrar/:idsucursal', (req, res)=>{
    const{idsucursal} = req.params;

    const query = `DELETE FROM sucursal2 WHERE idsucursal='${idsucursal}';`;
    conexion.query(query, (error)=>{
        if (error) return console.error(error.message);

        res.json('Se elimino correctamente');
    });
});

app.delete('/sucursal3/borrar/:idsucursal', (req, res)=>{
    const {idsucursal} = req.params;

    const query = `DELETE FROM sucursal3 WHERE idsucursal='${idsucursal}';`;
    conexion.query(query, (error)=>{
        if (error) return console.error(error.message);

        res.json('Se elimino correctamente')
    })
});

app.post('/usuarios/registro', async (req, res) => {
    const { usu_nombre, usu_correo, usu_contrasena, usu_tipoid, usu_identificacion, usu_numerotel } = req.body;
    
    try {
        const hashedPassword = await bcrypt.hash(usu_contrasena, saltRounds);

        const query = 'INSERT INTO usuarios (usu_nombre, usu_correo, usu_contrasena, usu_tipoid, usu_identificacion, usu_numerotel) VALUES (?, ?, ?, ?, ?, ?)';
        conexion.query(query, [usu_nombre, usu_correo, hashedPassword, usu_tipoid, usu_identificacion, usu_numerotel], (error) => {
            if (error) {
                console.error(error.message);
                return res.status(500).json('Error al registrar usuario');
            }

            res.json('Se registró correctamente el usuario');
        });
    } catch (error) {
        console.error(error.message);
        res.status(500).json('Error al encriptar la contraseña');
    }
});

app.post('/login', (req, res) => {
    const { usu_nombre, usu_contrasena } = req.body;

    const query = 'SELECT idusuarios, usu_nombre, idroles, usu_contrasena, usu_estado FROM usuarios WHERE usu_nombre=?';
    conexion.query(query, [usu_nombre], async (error, results) => {
        if (error) {
            console.error('Error durante el inicio de sesión: ' + error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        if (results.length === 1) {
            const user = results[0];
            const passwordMatch = await bcrypt.compare(usu_contrasena, user.usu_contrasena);
           
            if (passwordMatch) {
                res.json({
                    idusuarios: user.idusuarios,
                    usu_nombre: user.usu_nombre,
                    idroles: user.idroles,
                    usu_estado: user.usu_estado, // Incluir usu_estado en la respuesta
                    message: 'Inicio de sesión exitoso',
                });
            } else {
                res.status(401).json({ error: 'Credenciales inválidas' });
            }
        } else {
            res.status(401).json({ error: 'Credenciales inválidas' });
        }
    });
});
app.get('/genero', (req, res) => {
    const query = 'SELECT * FROM genero;';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay géneros');
        }
    });
});

app.get('/roles', (req, res) => {
    const query = 'SELECT * FROM roles;';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay roles');
        }
    });
});

app.get('/proplato', (req, res) => {
    const query = 'SELECT * FROM proplato;';
    conexion.query(query, (error, resultado) => {
        if (error) return console.error(error.message);

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.json('No hay productos de ese plato');
        }
    });
});

app.get('/proplato/:id', (req, res) => {
    const { id } = req.params;

    const query = `SELECT * FROM proplato WHERE proplaid=${id};`;
    conexion.query(query, (error, resultado) => {
        if (error) {
            console.error(error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        if (resultado.length > 0) {
            res.json(resultado);
        } else {
            res.status(404).json({ message: 'No hay productos para ese plato' });
        }
    });
});
app.get('/proplato/detalles/:id', (req, res) => {
    const id = req.params.id;
    const query = `SELECT * FROM proplato WHERE proplaid = ${id}`;
 
    conexion.query(query, (error, results) => {
      if (error) {
        console.error('Error al obtener los detalles del plato:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
 
      if (results.length === 0) {
        return res.status(404).json({ message: 'Plato no encontrado' });
      }
 
      res.json(results[0]); // Suponiendo que solo esperamos un resultado
    });
  });


app.post('/proplato/agregar', (req, res) => {
    const proplato = {
        idplatos: req.body.idplatos,
        idcategoria: req.body.idcategoria || null,
        idcategoria2: req.body.idcategoria2 || null,
        idcategoria3: req.body.idcategoria3 || null,
        idcategoria4: req.body.idcategoria4 || null,
        idcategoria5: req.body.idcategoria5 || null,
        idcategoria6: req.body.idcategoria6 || null,
        idcategoria7: req.body.idcategoria7 || null,
        idproducto: req.body.idproducto,
        cantidad: req.body.cantidad,
        idproducto2: req.body.idproducto2 || null,
        cantidad2: req.body.cantidad2 || null,
        idproducto3: req.body.idproducto3 || null,
        cantidad3: req.body.cantidad3 || null,
        idproducto4: req.body.idproducto4 || null,
        cantidad4: req.body.cantidad4 || null,
        idproducto5: req.body.idproducto5 || null,
        cantidad5: req.body.cantidad5 || null,
        idproducto6: req.body.idproducto6 || null,
        cantidad6: req.body.cantidad6 || null,
        idproducto7: req.body.idproducto7 || null,
        cantidad7: req.body.cantidad7 || null,
        idproducto8: req.body.idproducto8 || null,
        cantidad8: req.body.cantidad8 || null,
        idproducto9: req.body.idproducto9 || null,
        cantidad9: req.body.cantidad9 || null,

    };

    const query = 'INSERT INTO proplato SET ?';
    conexion.query(query, proplato, (error) => {
        if (error) {
            console.error(error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        res.json('Se insertó correctamente el producto del plato');
    });
});

app.put('/proplato/actualizar/:id', (req, res) => {
    const { id } = req.params;
    const { idplatos, idcategoria, idcategoria2, idcategoria3, idcategoria4, idcategoria5, idcategoria6, idcategoria7, idproducto, cantidad, idproducto2, cantidad2, idproducto3, cantidad3, idproducto4, cantidad4, idproducto5, cantidad5, idproducto6, cantidad6, idproducto7, cantidad7, idproducto8, cantidad8, idproducto9, cantidad9 } = req.body;

    const query = `UPDATE proplato SET idplatos=?, idcategoria=?, idcategoria2=?, idcategoria3=?, idcategoria4=?, idcategoria5=?, idcategoria6=?, idcategoria7=?, idproducto=?, cantidad=?, idproducto2=?, cantidad2=?, idproducto3=?, cantidad3=?, idproducto4=?, cantidad4=?, idproducto5=?, cantidad5=?, idproducto6=?, cantidad6=?, idproducto7=?, cantidad7=?, idproducto8=?, cantidad8=?, idproducto9=?, cantidad9=? WHERE proplaid=?`;
   
    const values = [idplatos, idcategoria, idcategoria2 || null, idcategoria3 || null, idcategoria4 || null, idcategoria5 || null, idcategoria6 || null, idcategoria7 || null, idproducto, cantidad, idproducto2 || null, cantidad2 || null, idproducto3 || null, cantidad3 || null, idproducto4 || null, cantidad4 || null, idproducto5 || null, cantidad5 || null, idproducto6 || null, cantidad6 || null, idproducto7 || null, cantidad7 || null, idproducto8 || null, cantidad8 || null, idproducto9 || null, cantidad9 || null, id];

    conexion.query(query, values, (error) => {
        if (error) {
            console.error(error.message);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        res.json('Se actualizó correctamente el producto del plato');
    });
});

app.put('/proplato/:id/productos', (req, res) => {
    const proplaid = req.params.id;

    // Actualizar la cantidad de productos en la tabla productos
    const updateQuery1 = `
    UPDATE sucursal1 AS p
    INNER JOIN proplato AS pp ON p.idproducto = pp.idproducto
    SET p.cantidad_producto =
        CASE
            WHEN (p.idproducto = pp.idproducto AND p.cantidad_producto - pp.cantidad < 0) THEN 0
            ELSE (p.cantidad_producto - pp.cantidad)
        END
    WHERE pp.proplaid = ${proplaid};
    `;

    const updateQuery2 = `
    UPDATE sucursal1 AS p
    INNER JOIN proplato AS pp ON p.idproducto = pp.idproducto2
    SET p.cantidad =
        CASE
            WHEN (p.idproducto = pp.idproducto2 AND p.cantidad_producto - pp.cantidad2 < 0) THEN 0
            ELSE (p.cantidad_producto - pp.cantidad2)
        END
    WHERE pp.proplaid = ${proplaid};
    `;

    const updateQuery3 = `
    UPDATE sucursal1 AS p
    INNER JOIN proplato AS pp ON p.idproducto = pp.idproducto3
    SET p.cantidad =
        CASE
            WHEN (p.idproducto = pp.idproducto3 AND p.cantidad_producto - pp.cantidad3 < 0) THEN 0
            ELSE (p.cantidad_producto - pp.cantidad3)
        END
    WHERE pp.proplaid = ${proplaid};
    `;

    const updateQuery4 = `
    UPDATE sucursal1 AS p
    INNER JOIN proplato AS pp ON p.idproducto = pp.idproducto4
    SET p.cantidad =
        CASE
            WHEN (p.idproducto = pp.idproducto4 AND p.cantidad_producto - pp.cantidad4 < 0) THEN 0
            ELSE (p.cantidad_producto - pp.cantidad4)
        END
    WHERE pp.proplaid = ${proplaid};
    `;

    const updateQuery5 = `
    UPDATE sucursal1 AS p
    INNER JOIN proplato AS pp ON p.idproducto = pp.idproducto5
    SET p.cantidad =
        CASE
            WHEN (p.idproducto = pp.idproducto5 AND p.cantidad_producto - pp.cantidad5 < 0) THEN 0
            ELSE (p.cantidad_producto - pp.cantidad5)
        END
    WHERE pp.proplaid = ${proplaid};
    `;

    const updateQuery6 = `
    UPDATE sucursal1 AS p
    INNER JOIN proplato AS pp ON p.idproducto = pp.idproducto6
    SET p.cantidad =
        CASE
            WHEN (p.idproducto = pp.idproducto6 AND p.cantidad_producto - pp.cantidad6 < 0) THEN 0
            ELSE (p.cantidad_producto - pp.cantidad6)
        END
    WHERE pp.proplaid = ${proplaid};
    `;

    const updateQuery7 = `
    UPDATE sucursal1 AS p
    INNER JOIN proplato AS pp ON p.idproducto = pp.idproducto7
    SET p.cantidad =
        CASE
            WHEN (p.idproducto = pp.idproducto7 AND p.cantidad_producto - pp.cantidad7 < 0) THEN 0
            ELSE (p.cantidad_producto - pp.cantidad7)
        END
    WHERE pp.proplaid = ${proplaid};
    `;

    const updateQuery8 = `
    UPDATE sucursal1 AS p
    INNER JOIN proplato AS pp ON p.idproducto = pp.idproducto8
    SET p.cantidad =
        CASE
            WHEN (p.idproducto = pp.idproducto8 AND p.cantidad_producto - pp.cantidad8 < 0) THEN 0
            ELSE (p.cantidad_producto - pp.cantidad8)
        END
    WHERE pp.proplaid = ${proplaid};
    `;

    const updateQuery9 = `
    UPDATE sucursal1 AS p
    INNER JOIN proplato AS pp ON p.idproducto = pp.idproducto9
    SET p.cantidad =
        CASE
            WHEN (p.idproducto = pp.idproducto9 AND p.cantidad_producto - pp.cantidad9 < 0) THEN 0
            ELSE (p.cantidad_producto - pp.cantidad9)
        END
    WHERE pp.proplaid = ${proplaid};
    `;

    // Ejecutar las consultas de actualización una por una
    conexion.query(updateQuery1, (error1, results1) => {
        if (error1) {
            console.error('Error al actualizar la cantidad de productos del plato:', error1);
            return res.status(500).json({ error: 'Error interno del servidor' });
        }

        conexion.query(updateQuery2, (error2, results2) => {
            if (error2) {
                console.error('Error al actualizar la cantidad de productos del plato:', error2);
                return res.status(500).json({ error: 'Error interno del servidor' });
            }

            conexion.query(updateQuery3, (error3, results3) => {
                if (error3) {
                    console.error('Error al actualizar la cantidad de productos del plato:', error3);
                    return res.status(500).json({ error: 'Error interno del servidor' });
                }

                conexion.query(updateQuery4, (error4, results4) => {
                    if (error4) {
                        console.error('Error al actualizar la cantidad de productos del plato:', error4);
                        return res.status(500).json({ error: 'Error interno del servidor' });
                    }

                    conexion.query(updateQuery5, (error5, results5) => {
                        if (error5) {
                            console.error('Error al actualizar la cantidad de productos del plato:', error5);
                            return res.status(500).json({ error: 'Error interno del servidor' });
                        }

                        conexion.query(updateQuery6, (error6, results6) => {
                            if (error6) {
                                console.error('Error al actualizar la cantidad de productos del plato:', error6);
                                return res.status(500).json({ error: 'Error interno del servidor' });
                            }

                            conexion.query(updateQuery7, (error7, results7) => {
                                if (error7) {
                                    console.error('Error al actualizar la cantidad de productos del plato:', error7);
                                    return res.status(500).json({ error: 'Error interno del servidor' });
                                }

                                conexion.query(updateQuery8, (error8, results8) => {
                                    if (error8) {
                                        console.error('Error al actualizar la cantidad de productos del plato:', error8);
                                        return res.status(500).json({ error: 'Error interno del servidor' });
                                    }

                                    conexion.query(updateQuery9, (error9, results9) => {
                                        if (error9) {
                                            console.error('Error al actualizar la cantidad de productos del plato:', error9);
                                            return res.status(500).json({ error: 'Error interno del servidor' });
                                        }

                                        // Una vez que todas las consultas se hayan ejecutado correctamente, responder al cliente
                                        res.json({ message: 'Cantidades de productos del plato actualizadas exitosamente' });
                                    });
                                });
                            });
                        });
                    });
                });
            });
        });
    });
});

app.get('/productos/verificarNombre/:nombre', (req, res) => {
    const { nombre } = req.params;
  
    const query = 'SELECT * FROM productos WHERE prod_nombre = ?';
    conexion.query(query, [nombre], (error, resultado) => {
      if (error) {
        console.error(error.message);
        return res.status(500).json({ error: 'Ocurrió un error al verificar el nombre del producto' });
      }
  
      if (resultado.length > 0) {
        res.json(true); 
      } else {
        res.json(false); 
      }
    });
  });

  app.get('/proveedores/exists/:nombre', (req, res) => {
    const { nombre } = req.params;
  
    const query = 'SELECT COUNT(*) AS count FROM proveedores WHERE pro_nombre = ?';
    conexion.query(query, [nombre], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
  
      const count = resultado[0].count;
      res.json(count > 0); 
    });
  });
  app.get('/proveedores/exists/direccion/:direccion', (req, res) => {
    const { direccion } = req.params;
  
    const query = 'SELECT COUNT(*) AS count FROM proveedores WHERE pro_direccion = ?';
    conexion.query(query, [direccion], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
  
      const count = resultado[0].count;
      res.json(count > 0); 
    });
  });
app.get('/proveedores/exists/correo/:correo', (req, res) => {
    const { correo } = req.params;
  
    const query = 'SELECT COUNT(*) AS count FROM proveedores WHERE pro_mail = ?';
    conexion.query(query, [correo], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
  
      const count = resultado[0].count;
      res.json(count > 0); 
    });
  });
  
  app.get('/proveedores/exists/telefono/:telefono', (req, res) => {
    const { telefono } = req.params;
  
    const query = 'SELECT COUNT(*) AS count FROM proveedores WHERE pro_telefono = ?';
    conexion.query(query, [telefono], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
  
      const count = resultado[0].count;
      res.json(count > 0); 
    });
  });
  app.get('/usuarios/exists/:nombre', (req, res) => {
    const { nombre } = req.params;
  
    const query = 'SELECT COUNT(*) AS count FROM usuarios WHERE usu_nombre = ?';
    conexion.query(query, [nombre], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
  
      const count = resultado[0].count;
      res.json(count > 0); 
    });
  });
  app.get('/usuarios/exists/identificacion/:identificacion', (req, res) => {
    const { identificacion } = req.params;
  
    const query = 'SELECT COUNT(*) AS count FROM usuarios WHERE usu_identificacion = ?';
    conexion.query(query, [identificacion], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
  
      const count = resultado[0].count;
      res.json(count > 0); 
    });
  });
app.get('/usuarios/exists/correo/:correo', (req, res) => {
    const { correo } = req.params;
  
    const query = 'SELECT COUNT(*) AS count FROM usuarios WHERE usu_correo = ?';
    conexion.query(query, [correo], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
  
      const count = resultado[0].count;
      res.json(count > 0); 
    });
  });
  
  app.get('/usuarios/exists/telefono/:telefono', (req, res) => {
    const { telefono } = req.params;
  
    const query = 'SELECT COUNT(*) AS count FROM usuarios WHERE usu_numerotel = ?';
    conexion.query(query, [telefono], (error, resultado) => {
      if (error) {
        console.error('Error al ejecutar la consulta:', error);
        return res.status(500).json({ error: 'Error interno del servidor' });
      }
  
      const count = resultado[0].count;
      res.json(count > 0); 
    });
  });
