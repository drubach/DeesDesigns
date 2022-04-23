""" Tools for cart. """
from django import template
from cart.contexts import cart_contents


register = template.Library()


@register.simple_tag(name='cart_grand_total')
def cart_grand_total(request):
    """
    Update grand total.
    """
    context = cart_contents(request)
    total = 0
    total = sum(item['price'] for item in context)
    return "{0:.2f}".format(total)
