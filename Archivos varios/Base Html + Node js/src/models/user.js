import Sequelize from 'sequelize';
import PassportLocalSequelize from 'passport-local-sequelize';
import config from '../config.json';

const db = new Sequelize(config.dbUri, { logging: false });

const User = db.define(
  'user',
  {
    user_id: {
      type: Sequelize.STRING,
      primaryKey: true
    },
    name: Sequelize.STRING,
    password_hash: Sequelize.STRING,
    password_salt: Sequelize.STRING,
    user_type_id: Sequelize.STRING,
    email: Sequelize.STRING,
  },
  {
    freezeTableName: true,
    timestamps: false
  }
);

PassportLocalSequelize.attachToUser(User, {
  usernameField: 'user_id',
  hashField: 'password_hash',
  saltField: 'password_salt'
});

User.update = (id, password, cb) => {
  User.findByUsername(id, (err, user) => {
    if (err)
      return cb(err);

    if (!user)
      return cb(new Error('El usuario no existe.'));

    user.setPassword(password, (err, user) => {
      if (err)
        return cb(err);

      user.setActivationKey((err, user) => {
        if (err)
          return cb(err);

        user['user_id'] = id;

        user.save()
          .then(() => {
            cb(null, user);
          })
          .catch((err) => {
            cb(err)
          });
      });
    });
  });
};

export default User;