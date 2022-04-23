""" Cart app views. """
from django.conf import settings
from django.shortcuts import render
from django.contrib.auth.decorators import login_required

from .forms import ProjectForm

# Create your views here.
def view_cart(request):
    """ A view that renders the contents of the cart. """

    return render(request, 'cart/cart.html')

@login_required
def add_project(request):
    """ Add proposed project info to cart. """
    if request.method == 'POST':
        cart = request.session.get('cart', [])
        project_name = request.POST.get('project_name')
        description = request.POST.get('description')
        project_type = int(request.POST.get('type'))
        print(project_type)
        redirect_url = 'cart/cart.html'

        if project_type == 1:
            price = settings.ICON_PRICE
        elif project_type == 2:
            price = settings.LOGO_PRICE
        elif project_type == 3:
            price = settings.POSTER_PRICE
        else:
            price = settings.PORT_MUR_PRICE

        project = {}
        project['project_name'] = project_name
        project['description'] = description
        project['project_type'] = project_type
        project['price'] = price
        cart.append(project)
        request.session['cart'] = cart

        print('this session', request.session['cart'])
        return render(request, redirect_url)

    else:
        form = ProjectForm()

        template = 'cart/add_project.html'
        
        context = {
            'form': form,
        }

        return render(request, template, context)
