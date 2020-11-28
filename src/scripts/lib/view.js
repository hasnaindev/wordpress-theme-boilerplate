const DOMElements = {
  images: document.getElementsByTagName('img'),
};

export const getLazyImages = () =>
  [DOMElements.images].filter((image) => image.getAttribute('data-lazy-src'));

export default DOMElements;
