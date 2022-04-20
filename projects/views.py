""" Views - Projects. """
from django.shortcuts import get_object_or_404, render 
from .models import Project, Type

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
