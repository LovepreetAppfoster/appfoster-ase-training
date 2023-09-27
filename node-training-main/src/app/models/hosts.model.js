// module.exports = (sequelize, Sequelize) => {
//     const Tutorial = sequelize.define("Employee", {
//       Name: {
//         type: Sequelize.STRING
//       },
//       Email: {
//         type: Sequelize.STRING
//       }
//     });
  
//     return employee;
//   };
  
module.exports = (sequelize, Sequelize) => {
  const Employee = sequelize.define('Employee', {
    // Model attributes are defined here
    firstName: {
      type: Sequelize.STRING,
      allowNull: false
    },
    lastName: {
      type: Sequelize.STRING
      // allowNull defaults to true
    }
  }, {
    // Other model options go here
    modelName: 'Employee'
  });

  console.log(Employee === sequelize.models.Employee);
  return Employee;
};

// `sequelize.define` also returns the model
 // true