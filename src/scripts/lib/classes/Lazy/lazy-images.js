import LazyImage from './lazy-image';

export default class LazyImages {
  static init(imageElements = []) {
    imageElements.map((image) => new LazyImage(image));
  }
}
