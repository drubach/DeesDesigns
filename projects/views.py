""" Views - Projects. """
from django.shortcuts import get_object_or_404, render , reverse, redirect
from django.contrib.auth.decorators import login_required
#from django.db.models import Q
from django.contrib import messages
from .models import Project, Type

from .forms import ProjectForm
#from cart.contexts import cart_contents


def all_projects(request):
    """ A view for all Projects page, including filtering. """

    projects = Project.objects.all()

    context = {
        'page': 'projects',
        'projects': projects,
    }

    return render(request, 'projects/projects.html', context)


def project_detail(request, project_id):
    """ A view to get project detail page. """

    project = get_object_or_404(Project, pk=project_id)

    context = {
        'page': 'projects',
        'project': project,
    }

    return render(request, 'projects/project_detail.html', context)


@login_required
def add_project(request):
    """ Add a product to the store """
    if not request.user.is_authenticated:
        messages.error(request, 'Sorry, you must be logged in to request a project.')
        return redirect(reverse('home'))

    if request.method == 'POST':
        form = ProjectForm(request.POST, request.FILES)
        if form.is_valid():
            project = form.save()
            messages.success(request, 'Successfully added project!')
            return redirect(reverse('project_detail', args=[project.id]))
        else:
            messages.error(request, 'Failed to add project. Please ensure the form is valid.')
    else:
        form = ProjectForm()

    template = 'projects/add_project.html'
    context = {
        'page': 'projects',
        'form': form,
    }

    return render(request, template, context)
