import { Directive, ElementRef, HostListener, Input } from '@angular/core';

@Directive({
  selector: '[appHighlight]'
})
export class HighlightDirective {

  @Input('appHighlight') highlightColor: string; // on peut utiliser un alias //

  @HostListener('mouseenter') onMouseEnter() { // "écouteur d'événement" //
    this.highlight(this.highlightColor || 'green'); // si on oublie d'attribuer une couleur, elle sera automatiquement en vert //
  }

  @HostListener('mouseleave') onMouseLeave() {
    this.highlight(null);
  }

  constructor(private elementRef: ElementRef) { } // pour injecter une référence dans un élément du DOM //

  private highlight(color: string) {
    this.elementRef.nativeElement.style.backgroundColor = color;
  }
}
