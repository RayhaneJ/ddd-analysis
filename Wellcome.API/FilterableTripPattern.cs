using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.API
{
    public class FilterableTripPattern : TripPattern
    {
        public int Rooms { get; set; }
        public int Beds { get; set; }
        public int Bathrooms { get; set; }
        public List<string> Equipments { get; set; }
    }

    public enum Equipment { }
}
