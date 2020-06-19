//importar archivo de configuracion (url base de datos y secret session)
const config = require('./config.json')
const { Pool } = require('pg')

const connectionString = config.dbUri

const pool = new Pool({
    connectionString: connectionString
})

module.exports = pool
