using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Microsoft.Extensions.DependencyInjection;
using RegisseurEnFilm.Domain.Data;

namespace RegisseurEnFilm.Domain
{
    public static class ServiceConfiguration
    {
        public static void RegisterServices(IServiceCollection services, String connectionString) 
        {
            services.AddSqlite<FilmContext>(connectionString);
        }
    }
}
