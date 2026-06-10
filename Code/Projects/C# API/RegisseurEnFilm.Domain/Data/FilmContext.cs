using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Microsoft.EntityFrameworkCore;
using RegisseurEnFilm.Domain.Entities;

namespace RegisseurEnFilm.Domain.Data
{
    public class FilmContext : DbContext
    {
        public FilmContext(DbContextOptions<FilmContext> options) : base(options) { }

        public DbSet<Regisseur> Regisseurs { get; set; }
        public DbSet<Film> Films { get; set; }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            base.OnModelCreating(modelBuilder);
            modelBuilder.Entity<Regisseur>().HasData(new Regisseur { Id = 1, Naam = "Jan Henken" });
            modelBuilder.Entity<Regisseur>().HasData(new Regisseur { Id = 2, Naam = "Simon Jansen" });
            modelBuilder.Entity<Film>().HasData(new Film
            {
                Id = 1,
                Titel = "Horizon De Films",
                Publicatiedatum = new DateTime(2025, 4, 5),
                RegisseurID = 1,
            });
            modelBuilder.Entity<Film>().HasData(new Film
            {
                Id = 2,
                Titel = "Horizon De Films",
                Publicatiedatum = new DateTime(2025, 4, 5),
                RegisseurID = 2,
            });
        }
    }
}
