""" Tools for cart. """
from django import template
from cart.contexts import cart_contents

register = template.Library()

@register.simple_tag(name='cart_grand_total')
def cart_grand_total(request):
    """
    Update grand total.
    """
    grand_total = cart_contents["grand_total"]
    return "{0:.2f}".format(grand_total)


    
    