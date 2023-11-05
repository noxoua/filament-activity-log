// https://www.npmjs.com/package/diff
const Diff = require('diff');

const getStringsDifference = (str1, str2, method = 'diffLines', options = {}) => {
  const result = Diff[method](str1, str2, options);

  return result
    .map((part) => {
      const color = part.added ? 'green' : part.removed ? 'red' : 'grey';
      return `<span style="color: ${color}">${part.value}</span>`;
    })
    .join('');
};

window.getStringsDifference = getStringsDifference;
