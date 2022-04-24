""" Tools for cart. """
from operator import itemgetter
from django import template
from cart.contexts import cart_contents


register = template.Library()


@register.simple_tag(name='cart_grand_total')
def cart_grand_total(request):
    """
    Update grand total.
    """
    cart = request.session.get('cart', [])
    context = cart_contents
    grand_total = cart_contents["total"]
    res_list = list(map(itemgetter('price'), cart))
    res_nl= [float(x) for x in res_list]
    total = sum(res_nl)
    print(total)
    
    cart_contents["total"]=total
    grand_total = total
    return "{0:.2f}".format(grand_total)


    
    